// alert('teest');
// nom de carte
// document.querySelector('.card-item').childNodes[3].childNodes[3].innerText
const Search = document.querySelector('#idSearch');

Search.addEventListener('input' , filterList);
function filterList(){
    const Search = document.querySelector('#idSearch');
    const filter = Search.value.toLowerCase();
    const cardItems = document.querySelectorAll('.card-item');
    // alert(Search);
    cardItems.forEach((item) =>{
        let text = item.childNodes[3].childNodes[3].innerText ;
        console.log(text);
        if(text.toLowerCase().includes(filter.toLowerCase())){
            
            item.style.display = '';
        console.log(text);

        }else{
            item.style.display = 'none';
        }
    })
}


