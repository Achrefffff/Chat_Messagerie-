const _ = (element) => {
  return document.getElementById(element);
};

const login_button = _("login_button");
login_button.addEventListener("click", (e) => {
  e.preventDefault();
  login_button.disabled = true;
  login_button.value = "Loading...";
  const formulaire = _("formulaire");
  const inputs = formulaire.getElementsByTagName("INPUT");
  const data = {};
  for (let i = inputs.length - 1; i >= 0; i--) {
    const key = inputs[i].name;
    switch (key) {
      case "email":
        data.email = inputs[i].value;
        break;
      case "password":
        data.password = inputs[i].value;
        break;
    }
  }
  send_data(data, "login");
});

const send_data = (data, type) => {
  let xml = new XMLHttpRequest();
  xml.onload = () => {
    if (xml.readyState == 4 || xml.status == 200) {
      handle_result(xml.responseText);
      login_button.disabled = false;
      login_button.value = "Connexion";
    }
  };
  data.data_type = type;
  let data_string = JSON.stringify(data);
  xml.open("POST", "api.php", true);
  xml.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xml.send(data_string);
};

const handle_result = (result) => {
  const data = JSON.parse(result);
  if (data.data_type == "info") {
    window.location = "index.html";
  } else if (data.data_type == "erreur") {
    const erreur = _("erreur");
    erreur.innerHTML = data.message;
    erreur.style.display = "block";
  }
};

