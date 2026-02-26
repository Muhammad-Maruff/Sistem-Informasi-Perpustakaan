<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rental Buku | Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <style>

    body{
      overflow-y:hidden;
    }

    .perpus img{
        width: 452px;
        aspect-ratio: auto 452 / 679;
        height: 730px;
    }

    .notif{
      position: absolute;
      margin-left: 20px;
      margin-top: 20px;
      z-index: 999999999999;
    }
</style>

  <body>
    <div class="notif">
      @if ($errors->any())
      <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </div>
      @endif

      @if (session('status'))
          <div class="alert alert-success">
              {{ session('message') }}
          </div>
      @endif

    </div>


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
                          <h5 class="fw-normal mb-3 ms-5 pb-3 mt-5" style="letter-spacing: 1px;">Register your account</h5>
                        </div>
      
                        
      
                        <div class="form-outline mb-4">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" id="username" class="form-control form-control-lg" name="username"/>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Password</label>  
                            <input type="password" id="password" class="form-control form-control-lg" name="password"/>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="nomor">Phone</label>  
                            <input type="string" id="nomor" class="form-control form-control-lg" name="phone"/>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="alamat">Address</label>  
                            <textarea class="form-control" id="alamat" rows="3" name="address"></textarea>
                        </div>
      
                        <div class="pt-1 mb-4">
                          <button class="btn btn-dark btn-lg btn-block" type="submit">Register</button>
                          <p class="mt-2 pb-lg-2" style="color: #393f81;">have an account? <a href="/login"
                            style="color: #393f81;">Login here</a></p>
                        </div>
      
                       
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