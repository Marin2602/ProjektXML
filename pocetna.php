
<!DOCTYPE html>
<html>
<head>
    <title>Prodavaonica patika - Rezultati pretrage</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
<h1 class="text-center">Pretraga brendova patika kao što su Nike, Adiadas, New Balance, Yezzy...</h1>
   

    <?php
    function pretraziAutePoMarki($marka) {
        $xmlFile = 'patike.xml';
        $patike = simplexml_load_file($xmlFile);
        $rezultati = [];

        foreach ($patike->proizvod as $proizvod) {
            if (strcasecmp($proizvod->marka, $marka) == 0) {
                $rezultati[] = [
                    'marka' => (string) $proizvod->marka,
                    'model' => (string) $proizvod->model,
                    'cijena' => (int) $proizvod->cijena,
                    'slika' => (string) $proizvod->slika 
                ];
            }
        }

        return $rezultati;
    }

    if (isset($_GET['marka'])) {
        $marka = $_GET['marka'];
        $rezultati = pretraziAutePoMarki($marka);
    }
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="GET">
                    <div class="form-group">
                        <label for="marka">Pretraži patike po marki:</label>
                        <input type="text" id="marka" name="marka" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Pretraži</button>
                </form>
            </div>
        </div>
    </div>
    <?php if (isset($rezultati) && count($rezultati) > 0): ?>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2 class="text-center">Rezultati pretrage</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Marka</th>
                                <th>Model</th>
                                <th>Cijena</th>
                                <th>Slika</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rezultati as $patike): ?>
                                <tr>
                                    <td><?php echo $patike['marka']; ?></td>
                                    <td><?php echo $patike['model']; ?></td>
                                    <td><?php echo $patike['cijena']; ?> €</td>
                                    <td><img class="img-fluid" src="<?php echo $patike['slika']; ?>" alt="<?php echo $patike['marka']; ?>"></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php elseif (isset($rezultati) && count($rezultati) == 0): ?>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <p class="text-center">Nema rezultata za traženu marku patika.</p>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
