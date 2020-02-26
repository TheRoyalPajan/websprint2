var api = {}
var defaultURL = "http://localhost/php/api/"
///{"den":3, "mesic":12}
api.getData =  function (url, post) {
    
fetch(url, {
    method: 'POST', 
    body: JSON.stringify(post) 
  })
    .then((response) => {
      return response.json();
    })
    .then((myJson) => {
      console.log(myJson);

  return myJson;
 

  });
  
};




