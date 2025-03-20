import './bootstrap';
var lista = document.getElementById('lista');
var data;

const getData = () => {
    axios.get('http://127.0.0.1:8000/productos').then(response => {
    //console.log(response.data);   
    data = response.data;   
    response.data.forEach(element => {
        let tag = document.createElement('a');
        tag.setAttribute('href', '/tienda/' + element.id);
        let li = document.createElement('li');
        li.innerHTML = element.nombre;
        lista.appendChild(tag);
        tag.appendChild(li);
        console.log(element.nombre);
    });
})
};

getData();


