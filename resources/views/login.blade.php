<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rental Buku | Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <style>
    .perpus img{
        width: 452px;
        aspect-ratio: auto 452 / 679;
        height: 679px;
    }
    .alert{
      margin-left: 20px;
      margin-top: 20px;
      z-index: 999999999999;
    }
</style>

  <body>
      @if (session('status'))
      <div class="alert alert-danger" style="position: absolute">
        {{ session('message') }}
      </div>
      @endif

  

    <section class="vh-100" style="background-image: url('https://lib.ub.ac.id/home/image//2022/11/Perpustakaan-Cover.jpg');">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
              <div class="card" style="border-radius: 1rem;">
                <div class="row g-0">
                  <div class="perpus col-md-6 col-lg-5 d-none d-md-block">
                    <img src="https://pghc.uma.ac.id/wp-content/uploads/2021/10/buku1.jpg"
                      alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                  </div>
                  
                  <div class="col-md-6 col-lg-7 d-flex align-items-center">
                    <div class="card-body p-4 p-lg-5 text-black">
      
                      <form action="" method="POST">
                        @csrf
                        <div class="d-flex align-items-center mb-3 pb-1">
                          <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                          <span class="h1 fw-bold mb-0">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/Perpustakaan_Nasional_Republik_Indonesia_insignia.svg/1200px-Perpustakaan_Nasional_Republik_Indonesia_insignia.svg.png" alt="" width="100px" height="100px">
                          </span>
                        </div>
                        
      
                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
      
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form2Example17">Username</label>
                            <input type="text" id="form2Example17" class="form-control form-control-lg" name="username" required/>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form2Example27">Password</label>  
                            <input type="password" id="form2Example27" class="form-control form-control-lg" name="password" required/>
                        </div>
      
                        <div class="pt-1 mb-4 text-center">
                          <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                        </div>
      
                        <a class="small text-muted" href="/">Back to Home</a>
                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="/register"
                            style="color: #393f81;">Register here</a></p>
                      </form>
      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>