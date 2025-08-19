<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>CacaoDx Registration</title>
  <link rel="stylesheet" href="<?= base_url('assets/styles/registrationstyles.css'); ?>">
</head>
<body>
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
            
            <!-- CI Form -->
            <form action="<?= site_url('auth/register'); ?>" method="post">
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" name="first_name" id="firstName" class="form-control form-control-lg" required />
                    <label class="form-label" for="firstName">First Name</label>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input type="text" name="last_name" id="lastName" class="form-control form-control-lg" required />
                    <label class="form-label" for="lastName">Last Name</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 d-flex align-items-center">
                  <div class="form-outline w-100">
                    <input type="date" name="birthday" class="form-control form-control-lg" id="birthdayDate" required />
                    <label for="birthdayDate" class="form-label">Birthday</label>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <h6 class="mb-2 pb-1">Gender: </h6>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="female" required />
                    <label class="form-check-label" for="femaleGender">Female</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="maleGender" value="male" />
                    <label class="form-check-label" for="maleGender">Male</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" id="otherGender" value="other" />
                    <label class="form-check-label" for="otherGender">Other</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 pb-2">
                  <div class="form-outline">
                    <input type="email" name="email" id="emailAddress" class="form-control form-control-lg" required />
                    <label class="form-label" for="emailAddress">Email</label>
                  </div>
                </div>
                <div class="col-md-6 mb-4 pb-2">
                  <div class="form-outline">
                    <input type="tel" name="phone" id="phoneNumber" class="form-control form-control-lg" required />
                    <label class="form-label" for="phoneNumber">Phone Number</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 pb-2">
                    <div class="form-outline">
                    <input type="password" name="password" class="form-control form-control-lg" required />
                    <label class="form-label">Password</label>
                    </div>
                </div>
                </div>


              <div class="mt-4 pt-2">
                <button class="btn btn-primary btn-lg" type="submit">Submit</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>