<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="MyProject">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>
        .: {{ config('app.name') }} {{  config('app.subname') }} - Login Website :.
    </title>
    <link rel="icon" type="image/png" href="{{ URL::asset('images/LOGO_KEMENAG.png') }}" />
    <link href="{{ URL::asset('authorization/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        html,
        body {
            font-family: 'Franklin Gothic', 'Arial Narrow', Arial, sans-serif;
            height: 100%;
        }
    </style>
</head>

<body class="my-login-page" style=" background: linear-gradient(to right, rgb(182, 244, 146), rgb(51, 139, 147));">
    <div style="margin-top: 60px"></div>
    <div class="row p-0 m-0" style="justify-content: center; align-items: center;">
        <div class="col-md-5">

            @if (session("error"))
            <div class="alert alert-danger">
                <strong>
                    Maaf
                </strong>,
                {!! session('error') !!}
            </div>
            @elseif(session("success"))
            <div class="alert alert-success">
                <strong>
                    Berhasil
                </strong>,
                {!! session('success') !!}
            </div>
            @endif

            <div class="card">
                <form action="{{ route('authorization.process') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="image">
                            <center>
                                <img src="{{ URL::asset('images/LOGO_KEMENAG.png') }}"
                                    style="width: 20%; height: 20%">
                            </center>
                        </div>
                        <h4 class="text-center" style="margin-top: 20px">
                            {{ config('app.name') }} {{  config('app.subname') }}
                        </h4>
                        <h6 class="text-center" style="color: gray">
                            Silahkan Login Terlebih Dahulu
                        </h6>

                        <div class="form-group">
                            <label for="email">Username</label>
                            <input type="text" class="form-control " name="username" id="username"
                                placeholder="Masukkan Username" value="{{ old('username') }}">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control " name="password" id="password"
                                placeholder="Masukkan Password" data-eye>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary btn-sm fw-bold"
                            style="width: 100%; background-color: #00A0F0">
                            <i class="fa fa-sign-in" style="margin-right: 5px"></i> MASUK
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ URL::asset('authorization/js/jquery.slim.min.js') }}">
    </script>
    <script src="{{ URL::asset('authorization/js/bootstrap.bundle.min.js') }}">
    </script>
    <script>
        $(function() {

            $("input[type='password'][data-eye]").each(function(i) {
                var $this = $(this),
                    id = 'eye-password-' + i,
                    el = $('#' + id);

                $this.wrap($("<div/>", {
                    style: 'position:relative',
                    id: id
                }));

                $this.css({
                    paddingRight: 60
                });
                $this.after($("<div/>", {
                    html: '<i class="fa fa-eye"></i>',
                    id: 'passeye-toggle-' + i,
                }).css({
                    position: 'absolute',
                    right: 10,
                    top: ($this.outerHeight() / 2) - 12,
                    padding: '2px 7px',
                    fontSize: 12,
                    cursor: 'pointer',
                }));

                $this.after($("<input/>", {
                    type: 'hidden',
                    id: 'passeye-' + i
                }));

                var invalid_feedback = $this.parent().parent().find('.invalid-feedback');

                if (invalid_feedback.length) {
                    $this.after(invalid_feedback.clone());
                }

                $this.on("keyup paste", function() {
                    $("#passeye-" + i).val($(this).val());
                });
                $("#passeye-toggle-" + i).on("click", function() {
                    if ($this.hasClass("show")) {
                        $this.attr('type', 'password');
                        $this.removeClass("show");
                        $(this).removeClass("btn-outline-primary");
                    } else {
                        $this.attr('type', 'text');
                        $this.val($("#passeye-" + i).val());
                        $this.addClass("show");
                        $(this).addClass("btn-outline-primary");
                    }
                });
            });

            $(".my-login-validation").submit(function() {
                var form = $(this);
                if (form[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.addClass('was-validated');
            });
        });
    </script>
</body>

</html>
