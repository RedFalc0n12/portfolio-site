document.addEventListener('DOMContentLoaded', function () {

  // ---- Menu mobile (abre/fecha a lista de seções) ----
  var botaoMenu = document.getElementById('botaoMenu');
  var listaIndice = document.getElementById('indiceLista');

  if (botaoMenu && listaIndice) {
    botaoMenu.addEventListener('click', function () {
      var aberto = listaIndice.classList.toggle('aberto');
      botaoMenu.setAttribute('aria-expanded', aberto ? 'true' : 'false');
    });

    listaIndice.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        listaIndice.classList.remove('aberto');
        botaoMenu.setAttribute('aria-expanded', 'false');
      });
    });
  }

  // ---- Destaca no índice a seção visível no momento ----
  var secoes = document.querySelectorAll('.secao');
  var links = document.querySelectorAll('.indice a');

  if (secoes.length && links.length && 'IntersectionObserver' in window) {
    var observadorSecoes = new IntersectionObserver(function (entradas) {
      entradas.forEach(function (entrada) {
        if (entrada.isIntersecting) {
          links.forEach(function (link) {
            link.classList.toggle('ativo', link.dataset.secao === entrada.target.id);
          });
        }
      });
    }, { rootMargin: '-40% 0px -55% 0px' });

    secoes.forEach(function (secao) {
      observadorSecoes.observe(secao);
    });
  }

  // ---- Revela os registros (experiência/formação) suavemente ao rolar ----
  var registros = document.querySelectorAll('.registro');

  if (registros.length && 'IntersectionObserver' in window) {
    var observadorRegistros = new IntersectionObserver(function (entradas, obs) {
      entradas.forEach(function (entrada) {
        if (entrada.isIntersecting) {
          entrada.target.classList.add('visivel');
          obs.unobserve(entrada.target);
        }
      });
    }, { threshold: 0.15 });

    registros.forEach(function (registro) {
      observadorRegistros.observe(registro);
    });
  } else {
    registros.forEach(function (registro) {
      registro.classList.add('visivel');
    });
  }
});
