const resultTable = document.getElementById("result");
const searchInput = document.getElementById("search");

function search(){
    if(!searchInput.value || searchInput.value.length <= 3){
        console.error("Меньше 3 символов")
    }
    else{
        searchInDB();
    }
}

async function searchInDB() {
    const searchInput = document.getElementById("search");
    const response = await fetch("http://localhost/search/?" + new URLSearchParams({
        sortColumn: searchInput.value,
    }).toString());
    const data = await response.json();
    generateTable(data);
};

function clearTable() {
    while (resultTable.firstChild) {
        resultTable.removeChild(resultTable.firstChild);
    }
};


function generateTable(data) {
    clearTable();
    const table = document.createElement("TABLE");

    for(let i = 0; i < data.length; i++) {
        const row = table.insertRow(i);
        row.insertCell(0).innerHTML = data[i].name;
        row.insertCell(1).innerHTML = data[i].body;
    }

    const header = table.createTHead();
    const headerRow = header.insertRow(0);
    const keys = Object.keys(data[0]);
    for(var i = 0; i < keys.length; i++) {
        headerRow.insertCell(i).innerHTML = keys[i];
    }

    resultTable.appendChild(table);

}



