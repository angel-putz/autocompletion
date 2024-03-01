$(function() { 
  $("#search").autocomplete({ // search est l'id de l'input du formulaire || search is the id of the form input
      source: function(request, response) { // la source est une fonction qui prend deux paramètres : request et response || the source is a function that takes two parameters: request and response
          $.ajax({
              url: "search.php", // l'url de la requête || the url of the request
              type: "GET", // le type de la requête || the type of the request
              data: request, // les données de la requête || the data of the request
              success: function(data) { // la fonction qui est appelée en cas de succès || the function that is called in case of success
                  var parsedData = JSON.parse(data); // on parse les données pour les transformer en objet || we parse the data to transform it into an object
                  var exactMatches = []; // on crée un tableau pour les correspondances exactes || we create an array for exact matches
                  var partialMatches = []; // on crée un tableau pour les correspondances partielles || we create an array for partial matches
                  $.each(parsedData, function(index, item) { // on parcourt les données pour les trier || we go through the data to sort it
                      if (item.label.startsWith(request.term)) { // si le terme de la requête est au début de l'élément actuel || if the term of the request is at the beginning of the current element
                          exactMatches.push(item); // on ajoute l'élément au tableau des correspondances exactes || we add the element to the array of exact matches
                      } else { // sinon
                          partialMatches.push(item); // on ajoute l'élément au tableau des correspondances partielles || we add the element to the array of partial matches
                      }
                  });
                  response(exactMatches.concat([{ label: "----", value: "" }]).concat(partialMatches)); // on appelle la fonction response avec les correspondances exactes, un élément de séparation et les correspondances partielles || we call the response function with the exact matches, a separation element and the partial matches
              }
          });
      },
      select: function(event, ui) { // la fonction qui est appelé en cas de selection d'un élément || the function that is called in case of selection of an element
          if (ui.item.value !== "") { // si la valeur de l'élément sélectionné n'est pas vide || if the value of the selected element is not empty
              window.location.href = 'element.php?id=' + ui.item.id; // on redirige vers la page de l'élément sélectionné || we redirect to the page of the selected element
          }
          return false;
      },
      minLength: 1 // le nombre de caractères minimum pour déclencher la recherche est de 1 || the minimum number of characters to trigger the search is 1
  });
});