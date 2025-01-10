// let fname = document.getElementById('fname');
// let lname = document.getElementById('lname');
// let uname = document.getElementById('uname');
// let email = document.getElementById('email');
// let pword = document.getElementById('pword');
// let contact = document.getElementById('contact');
// let form = document.getElementById('form');

// form.addEventListener('submit',(e)=>{
//     let messages = []
//     if(fname.value==='' || fname.value==null){
//         messages.push('First Name is required');
//     }

//     if(lname.value==='' || lname.value==null){
//         messages.push('Last Name is required');
//     }

//     if(uname.value==='' || uname.value==null){
//         messages.push('UserName is required');
//     }

//     if(pword.value==='' || pword.value==null){
//         messages.push('UserName is required');
//     }
   
//     if(pword.value.length<=8){
//         messages.push('Password must be longer thant 8 character');
//     }
   
//     if(contact.value==='' || contact.value==null){
//         messages.push('contact is required');
//     }

//     // if(contact.value.length<10 ||contact.value.length>10 ){
//     //     messages.push('Contact number should contain 10 numbers');
//     // }
//     // if(isNaN(contact.value) ){
//     //     messages.push('Contact number should contain numbers only');
//     //}


// e.preventDefault() 
// })


// Form Validation for First Name
const firstName = document.getElementById('first-name');
if (firstName.value === '') {
    alert('Please enter your first name');
}

// Form Validation for Last Name
const lastName = document.getElementById('last-name');
if (lastName.value === '') {
    alert('Please enter your last name');
}

// Form Validation for Email
const email = document.getElementById('email');
if (email.value === '') {
    alert('Please enter your email');
}

// Form Validation for Username
const username = document.getElementById('username');
if (username.value === '') {
    alert('Please enter your username');
}

// Form Validation for Password
const password = document.getElementById('password');
if (password.value === '') {
    alert('Please enter your password');
}

// Form Validation for Contact
const contact = document.getElementById('contact');
if (contact.value === '') {
    alert('Please enter your contact information');
}