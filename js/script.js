
const _ = (element) => {
  return document.getElementById(element);
};

const deco = _("logout");
deco.addEventListener("click", () => {
  const answer = confirm("Voulez-vous vraiment vous déconnecter ?");
  get_data({}, "logout");
});


const get_data = (find, type) => {
  console.log(find, type);
  let xml = new XMLHttpRequest();
  xml.onload = () => {
    if (xml.status == 200 || xml.readyState == 4) {
      handle_result(xml.responseText, type);
    }
  };
  let data = {};
  data.find = find;
  data.data_type = type;
  data = JSON.stringify(data);
  xml.open("POST", "api.php", true);
  xml.send(data);
};

const handle_result = (result, type) => {
  if (result.trim() !== "") {
    const obj = JSON.parse(result);
    console.log(obj);

    if (typeof obj.username !== "undefined") {
      let username = _("username");
      let email = _("email");

      username.innerHTML = obj.username;
      email.innerHTML = obj.email;
    } else if (
      typeof obj.message !== "undefined" &&
      obj.data_type === "error"
    ) {
      window.location.href = "login.html";
    } else if (type === "logout") {
      // Rediriger vers la page de connexion après la déconnexion
      window.location.href = "login.html";
    }
  }
};

get_data({}, "user_info");
