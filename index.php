<!DOCTYPE html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<?php
    // Mensagem Variavéis
    $msg = '';
    $msgClass = '';

    if(filter_has_var(INPUT_POST, 'submit')){
      $name = htmlspecialchars($_POST['name']);
      $email = htmlspecialchars($_POST['email']);
      $morada = htmlspecialchars($_POST['morada']);
      $passaporte = htmlspecialchars($_POST['passaporte']);
      $telefone = htmlspecialchars($_POST['telefone']);
      $data = htmlspecialchars($_POST['data']);
      $opcao = htmlspecialchars($_POST['opcao']);
      $mensagem = htmlspecialchars($_POST['mensagem']);

      // Checar se todos estes campos foram preenchidos
      if(!empty($email) && !empty($name) && !empty($morada)  
      && !empty($passaporte) && !empty($telefone)&& !empty($data) ){
        //Se todos os campos acima estiverem ok então
        //checar email
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
          // Se falhar mostrar esta mensagem:
          $msg = 'Por favor preecha um email válido.';
          $msgClass = 'alert-danger';
        }else{
          // Se passar enviar o email com o
          // Seguinte Formato
          $toEmail = 'mail@fernandoportugal.com';
          $subject = 'Mensagem Enviada por ' .$name;
          $body = '   <h2>Mensagem via website</h2>
                      <h4>Nome:</h4><p>'.$name.'</p>
                      <h4>Email:</h4><p>'.$email.'</p>
                      <h4>Morada:</h4><p>'.$morada.'</p>
                      <h4>Passaporte:</h4><p>'.$passaporte.'</p>
                      <h4>Telefone:</h4><p>'.$telefone.'</p>
                      <h4>Data:</h4><p>'.$data.'</p>
                      <h4>Opção: </h4><p>'.$opcao.'</p>
                      <h4>Mensagem: </h4><p>'.$mensagem.'</p>
          ';
          // Estilo do email que que será enviado
          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers.= "Content-Type:text/html;charset=UTF-8". "
          \r\n";
          
          // Infomações no título do email
          $headers .= "From: " .$name. "<".$email.">". "\r\n";

          if(mail($toEmail, $subject,$body,$headers)){
            // Mensagem na página de email enviado com sucesso
            $msg = 'Mensagem Enviada com Sucesso';
            $msgClass ='alert-success';
          }else{
            $msg = 'Ops! Mensagem não enviada! ';
            $msgClass ='alert-success';
          }
        }
      }else{
        // Se falhar mostrar esta mensagem
        $msg = 'Por favor preencha todos os campos';
        $msgClass = 'alert-danger';
      }
    }
?>
  <body>
    <div class="container pt-5">
      <div class="row">
        <div class="col-md-12 col-lg-12 border shadow rounded p-5">
          <!-- FORMULÁRIO -->
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="row">
          <!-- MOSTRA A MENSAGEM DE ACORDO COM O RESULTADO POSITIVO OU NEGATIVO -->
          <div class="form-group col-12">
          <?php if($msg != ''): ?>
            <div class="alert <?php echo $msgClass; ?>">
              <?php echo $msg; ?>
            </div>
            <?php endif; ?>
          </div>
            <div class="form-group col-6 col-sm-12 col-md-6 p-1">
              <label for="nome">Seu Nome</label>
                <input type="text" name="name" class="form-control" placeholder="Nome e Apelido"
                value="<?php echo isset($_POST['name']) ? $name: ''; ?>">
              </div>
              <div class="form-group col-6 col-sm-12 col-md-6 p-1">
              <label for="nome">Seu Email</label>
                <input type="text" name="email" class="form-control" placeholder="Email"
                value="<?php echo isset($_POST['email']) ? $email: ''; ?>">
              </div>
              <div class="form-group col-6 col-sm-12 col-md-6 p-1">
              <label for="nome">Sua Morada</label>
                <input type="text" name="morada" class="form-control" placeholder="Morada Completa"
                value="<?php echo isset($_POST['morada']) ? $morada: ''; ?>">
              </div>
              <div class="form-group col-6 col-sm-12 col-md-6 p-1">
              <label for="nome">Seu Passaporte</label>
                <input type="text" name="passaporte" class="form-control" placeholder="N° Passaporte"
                value="<?php echo isset($_POST['passaporte']) ? $passaporte: ''; ?>">
              </div>
              <div class="form-group col-6 col-sm-12 col-md-6 p-1">
              <label for="nome">Seu Telefone</label>
                <input type="text" name="telefone" class="form-control" placeholder="Telefone"
                value="<?php echo isset($_POST['telefone']) ? $telefone: ''; ?>">
              </div>
              <div class="form-group col-6 col-sm-12 col-md-6 p-1">
              <label for="nome">Data de Nascimento</label>
                <input type="text" name="data" class="form-control" placeholder="Data de Nascimento"
                value="<?php echo isset($_POST['telefone']) ? $data: ''; ?>">
              </div>
              <div class="form-group col-12  pt-2 text-center">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="opcao1" name="opcao" class="custom-control-input"
                  value="opcao1">
                  <label class="custom-control-label" for="opcao1">Opção 01</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="opcao2" name="opcao" class="custom-control-input"
                  value="opcao2">
                  <label class="custom-control-label" for="opcao2">Opção 02</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="opcao3" name="opcao" class="custom-control-input"
                  value="opcao3">
                  <label class="custom-control-label" for="opcao3">Opção 03</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="opcao4" name="opcao" class="custom-control-input"
                  value="opcao4">
                  <label class="custom-control-label" for="opcao4">Opção 04</label>
                </div>
              </div>
              <div class="form-group col-12">
              <label for="mensagem">Como posso ajudar?</label>
										<textarea name="mensagem" class="form-control" id="exampleFormControlTextarea1" placeholder="Sua Mensagem" rows="3" value="<?php echo isset($_POST['mensagem']) ? $mensagem: ''; ?>"></textarea>
									</div>
              <button type="submit" name="submit" class="btn btn-primary btn-lg mt-3 mx-auto">Enviar Mensagem</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



