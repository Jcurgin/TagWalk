document.addEventListener("DOMContentLoaded", async () => {
    const countriesList = document.getElementById("countries-list");
   
    try {
        const response = await fetch("https://api.tag-walk.com/api/users/countries");

        if (response.ok) {
            const countries = await response.json();

            countries.forEach(country => {
                const li = document.createElement("li");
                li.textContent = country.name;
                countriesList.appendChild(li);
            });
        } else {
            console.error(`Erreur HTTP: ${response.status}`);
        }
    } catch (error) {
        console.error("Erreur lors de la récupération des données:", error);
    }
});
