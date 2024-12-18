document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.addsignup-form');

    form.addEventListener('submit', (event) => {
        const Nom = document.getElementById('Nom').value.trim();
        const Prenom = document.getElementById('Prenom').value.trim();
        const date = document.getElementById('date').value.trim();
        const Email = document.getElementById('Email').value.trim();
        const Mot_de_passe = document.getElementById('Mot_de_passe').value;
    
        let errorMessage = '';

        // Validate name fields
        if (Nom.length < 2) {
            errorMessage += "Last name must be at least 2 characters long.\n";
        }
        if (Prenom.length < 2) {
            errorMessage += "First name must be at least 2 characters long.\n";
        }

        

        // Validate email format
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(Email)) {
            errorMessage += "Please enter a valid email address.\n";
        }

        // Validate password
        if (Mot_de_passe.length < 8) {
            errorMessage += "Password must be at least 6 characters long.\n";
        }
       
        // Display errors or submit form
        if (errorMessage) {
            alert(errorMessage);
            event.preventDefault();
        }
    });
});