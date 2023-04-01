<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
$this->registerJsFile('/js/auth.js', ['defer' => true]);
?>
<div class="d-flex justify-content-center align-items-center mt-5">


<div class="card">

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item text-center">
          <a class="nav-link active btl" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Ingresar</a>
        </li>
        <li class="nav-item text-center">
          <a class="nav-link btr" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Crear Cuenta</a>
        </li>
       
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          
          <div class="form px-4 pt-5" id="loginForm">

            <input type="text" name="email" class="form-control" placeholder="Email">

            <input type="password" name="password" class="form-control" placeholder="Password">
            <button type="button" class="btn btn-dark btn-block">Ingresar</button>

          </div>



        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
          

          <div class="form px-4" id="registerForm">

            <input type="text" name="name" class="form-control" placeholder="Name">

            <input type="text" name="email" class="form-control" placeholder="Email">

            <input type="password" name="password" class="form-control" placeholder="Password">

            <button type="button" class="btn btn-dark btn-block">Crear Cuenta</button>
            

          </div>



        </div>
        
       </div>
    
  
  

</div>


</div>