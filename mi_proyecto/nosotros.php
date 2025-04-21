<?php
require_once(__DIR__ . "/config.php"); // Definimos BASE_URL
?>

<?php include(__DIR__ . "/templates/header.php"); ?>

<?php include(__DIR__ . "/templates/banner.php"); ?>

<!-- Acerca de Nosotros -->
<section class="py-4" id="div-mision-vision">
  <div class="container">
    <h2 class="highlight text-center pb-5">- Acerca de Nosotros -</h2>
    <br>
    <div class="row">
      <div class="col-md-6">
        <h3 class="highlight text-center">Misión</h3>
        <p class="misión">
          En "El Paraíso", nuestra misión es cultivar y proporcionar plantas de alta calidad, fomentando la biodiversidad y la sostenibilidad. <br><br>
          Nos comprometemos a promover prácticas ecológicas que protejan y restauren el medio ambiente, educando a nuestra comunidad sobre la importancia de la conservación y el respeto por la naturaleza. <br><br>
          Nuestro objetivo es crear un oasis verde que inspire y facilite la conexión de las personas con el entorno natural, contribuyendo así a un planeta más saludable y equilibrado.
        </p>
      </div>
      <div class="col-md-6">
        <h3 class="highlight text-center">Visión</h3>
        <p class="visión">
          Ser un referente líder en la industria de los viveros, reconocido por nuestra dedicación a la sostenibilidad y la conservación del medio ambiente. <br><br>
          Aspiramos a expandir nuestra influencia, educando y capacitando a más personas en prácticas de jardinería ecológica, y colaborando con organizaciones medioambientales para implementar proyectos de reforestación y restauración de ecosistemas. <br><br>
          En "El Paraíso", visualizamos un futuro en el que cada hogar y comunidad pueda disfrutar de la belleza y los beneficios de un entorno verde y saludable, contribuyendo activamente a la protección de nuestro planeta para las generaciones venideras.
        </p>
      </div>
    </div>
    <p><br><br></p>
  </div>
</section>

<!-- Historia -->
<section class="py-4">
  <div class="container">
    <p><br><br></p><p><br><br></p>
    <div class="row">
      <div class="col-md-6">
        <h3 class="highlight text-center">Historia de "El Paraíso"</h3>
        <br>
              <p>"El Paraíso" nació de una pasión compartida por la naturaleza y un profundo compromiso con la conservación del medio ambiente. Su fundador, Manuel Fontalvo Coronado, siempre había sentido una conexión especial con la tierra. Creció rodeado de campos y jardines, donde aprendió desde joven el valor de cada planta y la importancia de cuidar el entorno natural. Inspirado por su amor por la jardinería y su preocupación por el impacto ambiental, Manuel decidió crear un espacio donde pudiera cultivar plantas de manera sostenible y promover una mayor conciencia ecológica. <br>
              <br>
              En 2010, con un pequeño terreno en las afueras de la ciudad y mucho entusiasmo, Manuel dio vida a su sueño y fundó "El Paraíso". Los primeros días fueron desafiantes, con limitados recursos y un equipo pequeño, pero el compromiso y la pasión de Manuel nunca flaquearon. Se centró en implementar prácticas de cultivo orgánicas, utilizando compost natural y métodos de control de plagas respetuosos con el medio ambiente. <br>
              <br>
              Con el tiempo, "El Paraíso" comenzó a ganar reputación por la calidad de sus plantas y su enfoque ecológico. Los clientes no solo venían en busca de plantas hermosas y saludables, sino también atraídos por la filosofía de sostenibilidad que promovía el vivero. Manuel empezó a ofrecer talleres educativos sobre jardinería ecológica y conservación del agua, ayudando a la comunidad a adoptar prácticas más sostenibles en sus propios jardines. <br>
              <br>
              La demanda creció, y con ella, el vivero. Manuel amplió el terreno y contrató a un equipo de personas igualmente apasionadas por el medio ambiente. Juntos, implementaron proyectos de reforestación y trabajaron en colaboración con organizaciones locales para restaurar áreas degradadas. <br>
              <br>
              Hoy, "El Paraíso" no es solo un vivero, sino un centro de aprendizaje y un modelo de sostenibilidad. La visión de Manuel de crear un oasis verde que inspire y eduque a las personas ha florecido, convirtiéndose en un pilar de la comunidad y un referente en la industria de viveros con un enfoque medioambiental. "El Paraíso" sigue creciendo, pero siempre con el mismo compromiso inquebrantable con la protección y el respeto por nuestro planeta. </p>
      </div>
      <div class="col-md-6">
        <img class="img-nosotros" src="<?= BASE_URL ?>/multimedia/img-nosotros.jpg" alt="Foto Nosotros">
      </div>
    </div>
    <p><br><br></p><p><br><br></p>
  </div>
</section>


<?php include(__DIR__ . "/templates/footer.php"); ?>
