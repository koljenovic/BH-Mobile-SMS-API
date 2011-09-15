<?php

require_once 'authform.php';

$config = new Config;
if($config->isSidSet()) {
    echo '<p><strong>Korak 3</strong>: Iz sigurnosnih razloga sada mozete ukloniti password iz config.php fajla<br /></p>';
    echo '<p>API je ispravno podesen i spreman za koristenje, ukoliko bilo kada invalidirate sesiju, ocistite config i ponovite install proceduru<br /><p>';
    echo '<p><strong>Pravno ogradjivanje</strong>: ovo je eksperimentalni API, ovaj API dolazi bez bilo kakvih garancija, posebno bez garancija o pouzdanosti, sigurnosti i funkcionalnosti, iako su u postizanju istih ulozeni najveci napori, za svaku eventualnu stetu, materijalne ili bilo koje druge prirode vi kao korisnik snosite punu odgovornost. Programer, distributeri ili bilo koje trece lice, koje nije korisnik API-ja, ne moze se smatrati odgovornim za bilo kakvu stetu nastalu koristenjem ovog API-ja.<br /></p><p style="color: red"><strong>Ukoliko niste saglasni sa gore navedenim uslovima molim vas da ne koristite ovaj API, te da ga uklonite sa vaseg sistema u najkracem roku!</strong></p>';
} elseif(!$config->isUserdataSet()) {
    echo '<p><strong>Korak 1</strong>: postavite vrijednost username i password varijabli u config.php <br /></p>';
} else {
    $request = new AuthForm;
    $sid = $request->dispatch()->getCookieJar()->getCookie('ticket');
    if(!$sid) {
        echo '<p>Unesite ispravne korisnicke podatke, mozete ih dobiti putem SMS-a preko http://bhmobile.ba/ <br /></p>';
    } else {
        echo '<p><strong>Korak 2</strong>: postavite vrijednost sid varijable u config.php na:<br /> ' . $sid . '<br /></p>';
    }
}

    echo '<p><a href="javascript:location.reload(true)">Dalje</a></p>';