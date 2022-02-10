<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{{  asset('css/calendar.css')  }}}">
    <link rel="stylesheet" href="{{{  asset('css/style.css')  }}}">
    <title>Calendrier</title>
</head>
<body>
    <header>
        @auth
        <div class="container-fluid bg-black-header">
            <nav class="position-relative nav-header">
                <ul class="nav flex-row align-items-center">
                    <a class="text-sm-center nav-link color-white" href="{{{  route('accueil.dashboard')  }}}"><li><img class="logo-header" src="{{{  asset('images/logo-header.png')  }}}" alt=""></li></a>
                    <a class="text-sm-center nav-link color-white" href="{{{  route('accueil.dashboard')  }}}"><li>Mon calendrier</li></a>
                    <a class="text-sm-center nav-link color-white" href="{{{  route('new.event.dashboard')  }}}"><li>Nouvel événement</li></a>
                    <a class="text-sm-center nav-link color-white" href="{{{  route('compte.user.dashboard')  }}}"><li>Mon compte</li></a>
                    @if(Auth::user()->role_user===1)
                        <a class="text-sm-center nav-link color-white" href="{{{  route('stats.users.dashboard')  }}}"><li>Admin</li></a>
                    @endif
                    <a id="btn-a-deconnexion" class="font-family-roboto fw-bold position-absolute right-70 text-sm-center nav-link color-white bg-color-green border-radius5" href="{{{  route('deconnexion')  }}}"><li class="btn-deconnexion">Déconnexion</li></a>
                </ul>
            </nav>
        </div>
        @endauth
        @if(Auth::user()=="")
        <div class="container-fluid bg-black-header">
            <nav class="position-relative nav-header">
                <ul class="nav flex-row align-items-center">
                    <a class="text-sm-center nav-link color-white" href="{{{  route('accueil')  }}}"><li><img class="logo-header" src="{{{  asset('images/logo-header.png')  }}}" alt=""></li></a>
                    <a class="text-sm-center nav-link color-white" href="{{{  route('accueil')  }}}"><li>Accueil</li></a>
                    <a class="text-sm-center nav-link color-white" href="{{{  route('connexion')  }}}"><li>Connexion</li></a>
                    <a class="text-sm-center nav-link color-white" href="{{{  route('inscription')  }}}"><li>Inscription</li></a>
                </ul>
            </nav>
        </div>
        @endif
    </header>




