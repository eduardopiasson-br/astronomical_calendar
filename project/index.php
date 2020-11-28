<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CALENDÁRIO ASTRONÔMICO</title>

  <!-- Css -->
  <link rel="stylesheet" href="../src/project/css/styles.css">
  <link rel="stylesheet" href="../src/project/css/calendar.css">
  <!-- <link rel="stylesheet" href="../src/project/css/solar_system.css"> -->
  <!-- Bootstrap Css -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <!-- Flaticon -->
  <link rel="shortcut icon" href="../src/project/images/icon.png" />
  <!-- Fontawesome icons -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <!-- Font-Family -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Goldman&display=swap" rel="stylesheet"></head>

<body>

  <sectio class="col-md-12 col-sm-12 top-menu">
      <div class="col-md-11 col-sm-11 title-menu">
        <h1>Calendário Astronômico</h1>
      </div>
      <div class="col-md-1 col-sm-1 menu-menu">
        <div class="dropdown">
          <button class="dropbtn"><i class="fas fa-caret-square-down"></i></button>
          <div class="dropdown-content">
            <a href="#">Galáxias</a>
            <a href="#">Sistemas</a>
            <a href="#">Estrelas</a>
            <a href="#">Planetas</a>
            <a href="#">Satelites</a>
            <a href="#">Cometas</a>
            <a href="#">Fenomenos</a>
            <a href="#">Missões</a>
            <a href="#">Lançamentos</a>
          </div>
        </div>
      </div>
  </section>

  <section style="display: flex;" class="col-md-12 col-sm-12">
    <div class="col-md-7 col-12">
      <table>
        <tr>
          <th class="day-name">Dom</th>
          <th class="day-name">Seg</th>
          <th class="day-name">Ter</th>
          <th class="day-name">Qua</th>
          <th class="day-name">Qui</th>
          <th class="day-name">Sex</th>
          <th class="day-name">Sab</th>
        </tr>
        <tr>
          <td class="day"><span class="number">31</span></td>
          <td class="day"><span class="number">1</span><span class="event"></span><span class="event"></span></td>
          <td class="day"><span class="number">2</span></td>
          <td class="day"><span class="number">3</span><span class="event event-multiday-start"></span></td>
          <td class="day"><span class="number">4</span><span class="event event-multiday"></span><span class="event event-multiday-start eventclass" style="background-color:#5a9ab2;"></span><span class="event"></td>
          <td class="day"><span class="number">5</span><span class="event event-multiday-finish"></span><span class="event event-multiday eventclass" style="background-color:#5a9ab2;"></span></td>
          <td class="day"><span class="number">6</span><span class="event event-ghost"></span><span class="event event-multiday-finish eventclass" style="background-color:#5a9ab2;"></span></td>
        </tr>
        <tr>
          <td class="day"><span class="number">7</span></td>
          <td class="day"><span class="number">8</span><span class="event"></span></td>
          <td class="day"><span class="number">9</span></td>
          <td class="day"><span class="number">10</span></td>
          <td class="day"><span class="number">11</span></td>
          <td class="day"><span class="number">12</span></td>
          <td class="day"><span class="number">13</span></td>
        </tr>
        <tr>
          <td class="day"><span class="number">14</span></td>
          <td class="day"><span class="number">15</span></td>
          <td class="day"><span class="number">16</span><span class="event"></span></td>
          <td class="day"><span class="number">17</span><span class="event"></span></td>
          <td class="day today"><span class="number">18</span></td>
          <td class="day"><span class="number">19</span></td>
          <td class="day"><span class="number">20</span></td>
        </tr>
        <tr>
          <td class="day"><span class="number">21</span></td>
          <td class="day"><span class="number">22</span></td>
          <td class="day"><span class="number">23</span></td>
          <td class="day"><span class="number">24</span></td>
          <td class="day"><span class="number">25</span></td>
          <td class="day"><span class="number">26</span></td>
          <td class="day"><span class="number">27</span><span class="event event-multiday-start" style="background-color:#da5f5f;"></td>
        </tr>
        <tr>
          <td class="day"><span class="number">28</span><span class="event event-multiday" style="background-color:#da5f5f;"></td>
          <td class="day"><span class="number">29</span><span class="event event-multiday-finish" style="background-color:#da5f5f;"></td>
          <td class="day"><span class="number">30</span></td>
          <td class="day"><span class="number">1</span></td>
          <td class="day"><span class="number">2</span></td>
          <td class="day"><span class="number">3</span></td>
          <td class="day"><span class="number">4</span></td>
        </tr>
        <tr>
          <td class="day"><span class="number">5</span></td>
          <td class="day"><span class="number">6</span><span class="event"></span></td>
          <td class="day"><span class="number">7</span></td>
          <td class="day"><span class="number">8</span></td>
          <td class="day"><span class="number">9</span></td>
          <td class="day"><span class="number">10</span></td>
          <td class="day"><span class="number">11</span></td>
        </tr>
      </table>
    </div>
    
    <!-- Day informations -->
    <div class="col-md-5 col-12">

    </div>
  </section>

  <!-- <section class="col-md-12 section-solar-system">
  <div class="universe-wrapper">
    <div class="stars-wrapper"></div>
    <div class="planets-wrapper">
      <div class="sun"></div>
      <div class="mercury"></div>
      <div class="venus"></div>
      <div class="earth"> </div>
      <div class="mars"> </div>
      <div class="jupiter"></div>
      <div class="saturn"></div>
      <div class="uranus"></div>
      <div class="neptune"></div>
      <div class="pluto"></div>
    </div>
  </div>
  </section> -->

</body>

<footer>
  <!-- <script type="javascript" src="../src/project/js/solar_system.js"></script> -->
</footer>

</html>