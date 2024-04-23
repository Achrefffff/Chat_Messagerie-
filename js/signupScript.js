const person = {
    name: "John",
    age: 30,
};
console.log(person.age);

const _ = (element) => {
  return document.getElementById(element);
};

const signup_button = _("signup_button");
signup_button.addEventListener("click", () => {
    const formulaire = _("formulaire");
    const inputs = formulaire.getElementsByTagName("INPUT");
    const data = {};
    for (let i = inputs.length-1; i>=0; i--) {
        const key =inputs[i].name
        switch (key) {
            case "username":
                data.username = inputs[i].value;
                break;
            case "email":
                data.email = inputs[i].value;
                break;
            case "password":
                data.password = inputs[i].value;
                break;
            case "password2":
                data.password2 = inputs[i].value;
                break;
            
        }
   }
   send_data(data,"signup");

}

);

const send_data = (data, type) => {
  let xml = new XMLHttpRequest();
  xml.onload = () => {
    if (xml.readyState == 4 || xml.status == 200) {
      alert(xml.responseText);
    }
  };
  data.data_type = type;
  let data_string = JSON.stringify(data);
  xml.open("POST", "api.php", true);
  xml.setRequestHeader("Content-Type", "application/json;charset=UTF-8"); 
  xml.send(data_string); 
};
