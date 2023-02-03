const nom_produit = document.getElementById('nom_produit');
const prix_produit = document.getElementById('prix_produit');
const img_produit = document.getElementById('img_produit');
const description = document.getElementById('description');
const form = document.getElementById('add_form');
const span = document.getElementById('span');


form.addEventListener('submit',(e)=>{
    let message = [];
    if(nom_produit.value === ''){
       message.push('name is required')
    }
})

