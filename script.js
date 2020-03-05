document.addEventListener("DOMContentLoaded",e=>{
  document.addEventListener("submit",event=>{
      event.preventDefault();

      let de = document.querySelector("#cboDe").value,
          a = document.querySelector("#cboA").value,
          cantidad = document.querySelector("#txtCantidad").value,
          $res = document.querySelector("#resultado");
      let monedas={
        "dolar": 1,
        "colones": 8.75,
        "yenes": 111.27,
        "rupias": 69.75,
        "lempiras": 24.36,
        "pesos": 19.36, 
        "bitcoin": 0.00026
      };
      $res.innerHTML = `Respuesta: ${ monedas[a] / monedas[de] * cantidad }`;
  });
});

