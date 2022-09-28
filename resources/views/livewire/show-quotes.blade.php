<div>
    <div class="loader"></div>
    <div id="app"></div>
    <div class="btn">
        <button onclick="refreshQuotes()">Refresh quotes</button>
    </div>
</div>

<script>

document.addEventListener('DOMContentLoaded', async function(){
    await getAndWriteQuotes();

    setInterval(function(){
        getAndWriteQuotes()
    }, 60000)
})

async function getAndWriteQuotes(){
    const loaderElement = document.getElementsByClassName("loader")[0]
    loaderElement.hidden = false
    const mainElement = document.getElementById("app");
    mainElement.innerHTML = ''

    const response = await axios.get('/api/office')

    let json = '';

    if (response.status == 200) {
        json = await response.data.data;
    }

    let html = '';

    for (const quote of json) {
        html += '<li>' + quote.quote + '</li>'
    }

    let list =  document.createElement('ul');
    list.innerHTML = html


    mainElement.appendChild(list)
    loaderElement.hidden = true
}

async function refreshQuotes(){
    await getAndWriteQuotes();
}

</script>

