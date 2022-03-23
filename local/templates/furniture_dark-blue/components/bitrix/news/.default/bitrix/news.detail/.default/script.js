window.onload = () => {
  const report = document.querySelector("#report-ajax");
  const text = document.querySelector("#response-text");
  const textGet = document.querySelector("#response-text-get");

  if (report) {
    report.addEventListener("click", function (e) {
      e.preventDefault();

      const response = BX.ajax.runComponentAction("custom:news.detail", "report", {
        mode: "class",
        data: {
          fields: {
            id: this.dataset.id
          }
        }
      });

      response.then(
        function (response) {
          if (response.status === 'success' && response.data !== null) {
            text.innerHTML = 'Ваше мнение учтено, №' + response.data
          } else {
            text.innerHTML = 'Ошибка!'
          }
        }
      )
    })
  }

  if (textGet) {
    if (textGet.dataset.res) {
      text.innerHTML = 'Ваше мнение учтено, №' + textGet.dataset.res
    } else {
      text.innerHTML = 'Ошибка!'
    }
  }

}
