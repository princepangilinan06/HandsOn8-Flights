<?php include 'includes/header.php'; ?>

<?php
$flights = [
    [
        "flightNo" => "PR 101",
        "airline" => "Philippine Airlines",
        "from" => "MNL",
        "fromName" => "Manila",
        "to" => "CEB",
        "toName" => "Cebu",
        "originTZ" => "Asia/Manila",
        "destTZ" => "Asia/Manila",
        "departure" => "2026-02-01 08:00",
        "duration" => 90,
        "type" => "Domestic"
    ],
    [
        "flightNo" => "5J 202",
        "airline" => "Cebu Pacific",
        "from" => "MNL",
        "fromName" => "Manila",
        "to" => "DVO",
        "toName" => "Davao",
        "originTZ" => "Asia/Manila",
        "destTZ" => "Asia/Manila",
        "departure" => "2026-02-01 09:30",
        "duration" => 120,
        "type" => "Domestic"
    ],
    [
        "flightNo" => "Z2 303",
        "airline" => "AirAsia PH",
        "from" => "CRK",
        "fromName" => "Clark",
        "to" => "ILO",
        "toName" => "Iloilo",
        "originTZ" => "Asia/Manila",
        "destTZ" => "Asia/Manila",
        "departure" => "2026-02-01 11:00",
        "duration" => 75,
        "type" => "Domestic"
    ],
    [
        "flightNo" => "PR 404",
        "airline" => "Philippine Airlines",
        "from" => "MNL",
        "fromName" => "Manila",
        "to" => "TAG",
        "toName" => "Bohol",
        "originTZ" => "Asia/Manila",
        "destTZ" => "Asia/Manila",
        "departure" => "2026-02-01 13:00",
        "duration" => 80,
        "type" => "Domestic"
    ],
    [
        "flightNo" => "5J 505",
        "airline" => "Cebu Pacific",
        "from" => "CEB",
        "fromName" => "Cebu",
        "to" => "BCD",
        "toName" => "Bacolod",
        "originTZ" => "Asia/Manila",
        "destTZ" => "Asia/Manila",
        "departure" => "2026-02-01 15:00",
        "duration" => 60,
        "type" => "Domestic"
    ],
    [
        "flightNo" => "PR 700",
        "airline" => "Philippine Airlines",
        "from" => "MNL",
        "fromName" => "Manila",
        "to" => "NRT",
        "toName" => "Tokyo",
        "originTZ" => "Asia/Manila",
        "destTZ" => "Asia/Tokyo",
        "departure" => "2026-02-02 07:00",
        "duration" => 260,
        "type" => "International"
    ],
    [
        "flightNo" => "SQ 901",
        "airline" => "Singapore Airlines",
        "from" => "MNL",
        "fromName" => "Manila",
        "to" => "SIN",
        "toName" => "Singapore",
        "originTZ" => "Asia/Manila",
        "destTZ" => "Asia/Singapore",
        "departure" => "2026-02-02 10:00",
        "duration" => 210,
        "type" => "International"
    ],
    [
        "flightNo" => "JL 800",
        "airline" => "Japan Airlines",
        "from" => "MNL",
        "fromName" => "Manila",
        "to" => "HND",
        "toName" => "Tokyohan",
        "originTZ" => "Asia/Manila",
        "destTZ" => "Asia/Tokyo",
        "departure" => "2026-02-02 12:30",
        "duration" => 255,
        "type" => "International"
    ],
    [
        "flightNo" => "CX 600",
        "airline" => "Cathay Pacific",
        "from" => "MNL",
        "fromName" => "Manila",
        "to" => "HKG",
        "toName" => "Hong Kong",
        "originTZ" => "Asia/Manila",
        "destTZ" => "Asia/Hong_Kong",
        "departure" => "2026-02-02 16:00",
        "duration" => 150,
        "type" => "International"
    ],
    [
        "flightNo" => "EK 335",
        "airline" => "Emirates",
        "from" => "MNL",
        "fromName" => "Manila",
        "to" => "DXB",
        "toName" => "Dubai",
        "originTZ" => "Asia/Manila",
        "destTZ" => "Asia/Dubai",
        "departure" => "2026-02-02 18:00",
        "duration" => 540,
        "type" => "International"
    ],
];
?>

<?php foreach (["Domestic", "International"] as $category): ?>
<h2 class="section-title"><?= $category ?> Flights</h2>

<div class="card-grid">
<?php foreach ($flights as $flight): ?>
<?php if ($flight["type"] === $category):

    $originTZ = new DateTimeZone($flight["originTZ"]);
    $destTZ   = new DateTimeZone($flight["destTZ"]);

    $dep = new DateTime($flight["departure"], $originTZ);

    $arr = clone $dep;
    $arr->add(new DateInterval("PT{$flight['duration']}M"));
    $arr->setTimezone($destTZ);

    $duration = $dep->diff($arr);

    $imgName = strtolower(str_replace([' ', '(', ')'], '', $flight["toName"])) . ".png";
?>

<div class="flight-card">
    <img src="images/<?= $imgName ?>" alt="<?= $flight["toName"] ?>">

    <div class="card-content">
        <h3><?= $flight["flightNo"] ?></h3>
        <p class="airline"><?= $flight["airline"] ?></p>

        <p>
            <strong><?= $flight["fromName"] ?></strong>
            →
            <strong><?= $flight["toName"] ?></strong>
        </p>

        <p>
            Departure: <?= $dep->format("M d, Y h:i A") ?>
            <small>(<?= $flight["originTZ"] ?>)</small>
        </p>

        <p>
            Arrival: <?= $arr->format("M d, Y h:i A") ?>
            <small>(<?= $flight["destTZ"] ?>)</small>
        </p>

        <p>
            Duration: <?= $duration->h ?>h <?= $duration->i ?>m
        </p>

        <span class="timezone">
            <?= $flight["originTZ"] ?> → <?= $flight["destTZ"] ?>
        </span>
    </div>
</div>

<?php endif; endforeach; ?>
</div>
<?php endforeach; ?>

<?php include 'includes/footer.php'; ?>
