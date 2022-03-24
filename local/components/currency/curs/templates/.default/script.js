window.onload = () => {
  const reload = document.querySelector("#reload-data");
  const table = document.querySelectorAll(".table-curs");

  if (reload) {

    function curs(e) {
      // e.preventDefault();
      const response = BX.ajax.runComponentAction("currency:curs", "getCurs", {
        mode: "class",
        data: {
          fields: {
            id: ''
          }
        }
      });

      response.then(
        function (response) {
          if (response.status === 'success') {
            response.data.forEach((element, key) => {
              table[key].innerHTML = `<td> ${key + 1} </td>` + "<td>" + element.CURRENCY + "</td>" + "<td>" + element.RATE + "</td>" + "<td>" + new Date(element.DATE).toLocaleDateString() + "</td>"

            })

          } else {
            // text.innerHTML = 'Ошибка!'
          }
        }
      )
    }
    // setInterval(curs, 60000)
    // reload.addEventListener("click", curs)
  }
}