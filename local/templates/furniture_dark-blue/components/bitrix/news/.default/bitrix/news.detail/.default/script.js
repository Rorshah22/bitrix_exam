window.onload = () => {
  const report = document.querySelector("#report-ajax");
  const text = document.querySelector("#response-text");

  if (report) {
    report.addEventListener("click", e => {
      // console.log('object');
      const response = BX.ajax.runComponentAction("custom:news.detail", "report", {
        mode: "ajax",
        data: {
          post: {
            name: "TEST"
          }
        }
      });
      response.then(
        function (response) {
          if (response.status === 'success') {
            text.innerHTML = 'Ваше мнение учтено, №'
            console.log(response);
          }

        }
      )
    })
  }

}
