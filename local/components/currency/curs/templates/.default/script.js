window.onload = () => {
  const reload = document.querySelector("#reload-data");
  const table = document.querySelectorAll(".table-curs");

  if (reload) {


    reload.addEventListener("click", (e) => {
      e.preventDefault();
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
              table[key].innerHTML = `<td> ${key + 1} </td>` + "<td style='text-align: end'>" + element.CURRENCY + "</td>" + "<td style='text-align: end'>" + element.RATE + "</td>" + "<td style='text-align: end'>" + new Date(element.DATE).toLocaleDateString() + "</td>"

            })

          } else {
            // text.innerHTML = 'Ошибка!'
          }
        }
      )
    })
  }
}