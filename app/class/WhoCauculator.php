<?php

class WhoCauculator{
    
    public function __construct(){
        
        $theme = new ThemeWho();

        $theme->setTitle("Kaukulacka");

        $content = '
            <div class="articles">
            <script>      
            function isInputNumber(evt){
                var ch = String.fromCharCode(evt.which);
                if(!(/[0-9\.]/.test(ch))){
                    evt.preventDefault();
                }
            }
            </script>
            <form action="'. Link::to("who", "cauculator") . '"method="post" style="padding:20px" enctype="multipart/form-data">
                <h1>Matika</hi>
                <br>
                <br>
                <h2>Delenie</h2>
                <div class="kaukulacka">
                    <input type="text" onkeypress="isInputNumber(event)" name="1cislo" style="width: 60px">
                </div>
                <div class="kaukulacka">
                     : <input type="text" onkeypress="isInputNumber(event)" name="2cislo" style="width: 60px">
                </div>
                <button type="submit" name="submit_del">=</button>
                <br>
                <br>
                <div>'. $this->del() .'</div>
                <br>
                <br>
                <h2>Násobenie</h2>
                <div class="kaukulacka">
                    <input type="text" onkeypress="isInputNumber(event)" name="3cislo" style="width: 60px">
                </div>
                <div class="kaukulacka">
                     . <input type="text" onkeypress="isInputNumber(event)" name="4cislo" style="width: 60px"><button type="submit" name="submit_nasob">=</button><div>'. $this->nasob() .'</div>
                </div>
                <br>
                <br>
                <br>
                <h2>Trojuholnik</h2>
                <input type="checkbox" name="obsah_thojuholnika" checked>Obsah
                <input type="checkbox" name="cislo3">3. cislo
                <br>
                <div class="kaukulacka">
                    a=<input type="text" onkeypress="isInputNumber(event)" name="trojuholnik_a" style="width: 60px">
                    <select name="jednotka_trojuholnik_a">
                        <option value="mm">mm</option>
                        <option value="cm">cm</option>
                        <option value="dm">dm</option>
                        <option value="m">m</option>
                        <option vaue="km">km</option>
                    </select>
                </div>
                <br>
                <br>
                <div class="kaukulacka">
                    b=<input type="text" onkeypress="isInputNumber(event)" name="trojuholnik_b" style="width: 60px">
                    <select name="jednotka_trojuholnik_b">
                        <option value="mm">mm</option>
                        <option value="cm">cm</option>
                        <option value="dm">dm</option>
                        <option value="m">m</option>
                        <option value="km">km</option>
                    </select>
                </div>
                <br>
                <br>
                <div class="kaukulacka">
                    Va=<input type="text" onkeypress="isInputNumber(event)" name="trojuholnik_va" style="width: 60px">
                    <select name="jednotka_trojuholnik_va">
                        <option value="mm">mm</option>
                        <option value="cm">cm</option>
                        <option value="dm">dm</option>
                        <option value="m">m</option>
                        <option value="km">km</option>
                    </select>
                </div>
                <br>
                <br>
                <div class="kaukulacka">
                    S=<input type="text" onkeypress="isInputNumber(event)" name="trojuholnik_s" style="width: 60px">
                    <select name="jednotka_trojuholnik_s">
                        <option value="mm">mm2</option>
                        <option value="cm">cm2</option>
                        <option value="dm">dm2</option>
                        <option value="m">m2</option>
                        <option value="km">km2</option>
                    </select>
                </div>
                <br>
                <br>
                <button type="submit" name="submit_trojuholnik">=</button>
                <select name="jednotky_trojuholnik">
                    <option value="mm">mm</option>
                    <option value="cm">cm</option>
                    <option value="dm">dm</option>
                    <option value="m">m</option>
                    <option value="km">km</option>
                </select>
                <p>'. $this->trojuholnik() .'</p>
                <br>
                <br>
                <h2>Pocitanie objemu a povrchu kocky a kvadra</h2>
                <input type="checkbox" name="obsah" checked>Obsah
                <input type="checkbox" name="povrch" checked>Povrch
                <input type="checkbox" name="3strana">3. Strana
                <br>
                <div class="kaukulacka">
                    a=<input type="text" onkeypress="isInputNumber(event)" name="5cislo" style="width: 60px">
                    <select name="jednotkaa">
                        <option value="mm">mm</option>
                        <option value="cm">cm</option>
                        <option value="dm">dm</option>
                        <option value="m">m</option>
                        <option vaue="km">km</option>
                    </select>
                </div>
                <br>
                <br>
                <div class="kaukulacka">
                    b=<input type="text" onkeypress="isInputNumber(event)" name="6cislo" style="width: 60px">
                    <select name="jednotkab">
                        <option value="mm">mm</option>
                        <option value="cm">cm</option>
                        <option value="dm">dm</option>
                        <option value="m">m</option>
                        <option value="km">km</option>
                    </select>
                </div>
                (ak pocitas kocku, nevyplň toto pole)
                <br>
                <br>
                <div class="kaukulacka">
                    c=<input type="text" onkeypress="isInputNumber(event)" name="7cislo" style="width: 60px">
                    <select name="jednotkac">
                        <option value="mm">mm</option>
                        <option value="cm">cm</option>
                        <option value="dm">dm</option>
                        <option value="m">m</option>
                        <option value="km">km</option>
                    </select>
                </div>
                (ak pocitas kocku alebo 3. stranu, nevyplň toto pole)
                <br>
                <br>
                <div class="kaukulacka">
                    V=<input type="text" onkeypress="isInputNumber(event)" name="objem" style="width: 60px">
                    <select name="jednotka3">
                        <option value="mm">mm³</option>
                        <option value="cm">cm³</option>
                        <option value="dm">dm³</option>
                        <option value="m">m³</option>
                        <option vaue="km">km³</option>
                        <option value="ml">ml</option>
                        <option value="cl">cl</option>
                        <option value="dcl">dcl</option>
                        <option value="l">l</option>
                        <option vaue="hl">hl</option>
                    </select>
                </div>
                (vzplň ak pocitas 3. srtanu)
                <br>
                <br>
                <button type="submit" name="submit_obsah">=</button>
                <select name="jednotky">
                    <option value="mm">mm</option>
                    <option value="cm">cm</option>
                    <option value="dm">dm</option>
                    <option value="m">m</option>
                    <option value="km">km</option>
                </select>
                <p>'. $this->obsah_povrch_3strana() .'</p>
                <br>
                <br>
                <h2>Pomer</h2>
                <br>
                <h4>zmeň </h4>
                <div class="kaukulacka">
                    <input type="text" onkeypress="isInputNumber(event)" name="pomer_cislo1" style="width: 60px">
                </div>
                <h4> v pomere </h4>
                <div class="kaukulacka">
                    <input type="text" onkeypress="isInputNumber(event)" name="pomer_cislo2" style="width: 60px">
                </div>
                <div class="kaukulacka">
                     : <input type="text" onkeypress="isInputNumber(event)" name="pomer_cislo3" style="width: 60px">
                </div>
                <button type="submit" name="submit_zmen_v_pomere">=</button>
                <br>
                <div>'. $this->zmen_v_pomere() .'</div>
                <br>
                <br>
                <h4>rozdel </h4>
                <div class="kaukulacka">
                    <input type="text" onkeypress="isInputNumber(event)" name="pomer_cislo4" style="width: 60px">
                </div>
                <h4> v pomere </h4>
                <div class="kaukulacka">
                    <input type="text" onkeypress="isInputNumber(event)" name="pomer_cislo5" style="width: 60px">
                </div>
                <div class="kaukulacka">
                     : <input type="text" onkeypress="isInputNumber(event)" name="pomer_cislo6" style="width: 60px">
                </div>
                <div class="kaukulacka">
                     : <input type="text" onkeypress="isInputNumber(event)" name="pomer_cislo7" style="width: 60px">
                </div>
                <button type="submit" name="submit_rozdel_v_pomere">=</button>
                <br>
                <div>'. $this->rozdel_v_pomere() .'</div>
                <br>
                <br>
                <h2>Percentá</h2>
                <br>
                <br>
                <div class="kaukulacka">
                     z= <input type="text" onkeypress="isInputNumber(event)" name="percenta_cisloz" style="width: 60px">(100%)
                </div>
                <br>
                <br>
                <div class="kaukulacka">
                     p= <input type="text" onkeypress="isInputNumber(event)" name="percenta_cislop" style="width: 60px">%
                </div>
                <br>
                <br>
                <div class="kaukulacka">
                     č= <input type="text" onkeypress="isInputNumber(event)" name="percenta_cisloc" style="width: 60px">
                </div>
                <br>
                <br>
                <button type="submit" name="submit_percenta">=</button>
                <div>'. $this->percenta() .'</div>
                <br>
                <br>
                <h2>Hranol</h2>
                <br>
                <br>
                <select name="hranol">
                    <option value="4">Štvorboký hranol []</option>
                    <option value="3">Trojboký hranol <|</option>
                </select>
                <br>
                <input type="checkbox" name="hranol_obsah" checked>Obsah
                <input type="checkbox" name="hranol_povrch" checked>Povrch
                <br>
                <br>
                <div class="kaukulacka">
                    a=<input type="text" onkeypress="isInputNumber(event)" name="hranola" style="width: 60px">
                    <select name="jednotkahranola">
                        <option value="mm">mm</option>
                        <option value="cm">cm</option>
                        <option value="dm">dm</option>
                        <option value="m">m</option>
                        <option vaue="km">km</option>
                    </select>
                </div>
                <br>
                <br>
                <div class="kaukulacka">
                    b=<input type="text" onkeypress="isInputNumber(event)" name="hranolb" style="width: 60px">
                    <select name="jednotkahranolab">
                        <option value="mm">mm</option>
                        <option value="cm">cm</option>
                        <option value="dm">dm</option>
                        <option value="m">m</option>
                        <option vaue="km">km</option>
                    </select>
                </div>
                <br>
                <br>
                <div class="kaukulacka">
                    Va=<input type="text" onkeypress="isInputNumber(event)" name="hranolva" style="width: 60px">
                    <select name="jednotkahranolva">
                        <option value="mm">mm</option>
                        <option value="cm">cm</option>
                        <option value="dm">dm</option>
                        <option value="m">m</option>
                        <option vaue="km">km</option>
                    </select>
                </div>
                <br>
                <br>
                <div class="kaukulacka">
                    Vh=<input type="text" onkeypress="isInputNumber(event)" name="vh" style="width: 60px">
                    <select name="jednotkavh">
                        <option value="mm">mm</option>
                        <option value="cm">cm</option>
                        <option value="dm">dm</option>
                        <option value="m">m</option>
                        <option value="km">km</option>
                    </select>
                </div>
                <br>
                <br>
                <button type="submit" name="submit_hranol">=</button>
                <select name="jednotkavysledok">
                    <option value="mm">mm</option>
                    <option value="cm">cm</option>
                    <option value="dm">dm</option>
                    <option value="m">m</option>
                    <option value="km">km</option>
                </select>
                <p>'. $this->povrch_hranol() .'</p>
                <br>
                <br>
                <h1>Fyzika</h1>
                <br>
                <br>
                <h2>Hustota</h2>
                <div class="kaukulacka">
                    m=<input type="text" onkeypress="isInputNumber(event)" name="hmotnost" style="width: 60px">
                    <select name="jednotka_hmotnosti">
                        <option value="mg">mg</option>
                        <option value="g">g</option>
                        <option value="dkg">dkg</option>
                        <option value="kg">kg</option>
                        <option value="q">q</option>
                        <option value="t">t</option>
                    </select>
                </div>
                (hmotnosť)
                <br>
                <br>
                <div class="kaukulacka">
                    V=<input type="text" onkeypress="isInputNumber(event)" name="objemfyz" style="width: 60px">
                    <select name="jednotka_objem">
                        <option value="mm">mm³</option>
                        <option value="cm">cm³</option>
                        <option value="dm">dm³</option>
                        <option value="m">m³</option>
                        <option vaue="km">km³</option>
                        <option value="ml">ml</option>
                        <option value="cl">cl</option>
                        <option value="dcl">dcl</option>
                        <option value="l">l</option>
                        <option vaue="hl">hl</option>
                    </select>
                </div>
                <br>
                <br>
                <div class="kaukulacka">
                    ρ=<input type="text" onkeypress="isInputNumber(event)" name="roo" style="width: 60px">
                    <select name="jednotka_ro">
                        <option value="g/cm³">g/cm³</option>
                        <option value="kg/m³">kg/m³</option>
                    </select>
                </div>
                <br>
                <br>
                <button type="submit" name="submit_hustota">=</button>
                <div>'. $this->hustota() .'</div>
                <br>
                <br>
                <h2>Hmotnostná/mernátepelná kapacita, teplo a teplotný rozdiel</h2>
                <br>
                <div class="kaukulacka">
                    m=<input type="text" onkeypress="isInputNumber(event)" name="hmotnost1" style="width: 60px">
                    <select name="jednotka_hmotnosti1">
                        <option value="mg">mg</option>
                        <option value="g">g</option>
                        <option value="dkg">dkg</option>
                        <option value="kg">kg</option>
                        <option value="q">q</option>
                        <option value="t">t</option>
                    </select>
                </div>
                (hmotnosť)
                <br>
                <br>
                <div class="kaukulacka">
                    c=<input type="text" onkeypress="isInputNumber(event)" name="cisloc" style="width: 60px">
                    <select name="jednotkac">
                        <option value="mJ">mJ/kg ºC</option>
                        <option value="J">J/kg ºC</option>
                        <option value="kJ">kJ/kg ºC</option>
                        <option value="MJ">MJ/kg ºC</option>
                        <option value="GJ">GJ/kg ºC</option>
                        <option value="TJ">TJ/kg ºC</option>
                    </select>
                </div>
                <br>
                <br>
                <div class="kaukulacka">
                <| t=<input type="text" onkeypress="isInputNumber(event)" name="deltat" style="width: 60px">
                     ºC
                </div>
                <br>
                <br>
                <div class="kaukulacka">
                    Q=<input type="text" onkeypress="isInputNumber(event)" name="teplo" style="width: 60px">
                    <select name="jednotka_teplo">
                        <option value="mJ">mJ</option>
                        <option value="J">J</option>
                        <option value="kJ">kJ</option>
                        <option value="MJ">MJ</option>
                        <option value="GJ">GJ</option>
                        <option value="TJ">TJt</option>
                    </select>
                </div>
                <br>
                <br>
                <button type="submit" name="submit_teplo">=</button>
                <div>'. $this->teplo() .'</div>
                <br>
                <br>
                <h2>Sila</h2>
                <br>
                <br>
                F1=<input type="text" onkeypress="isInputNumber(event)" name="f1" style="width: 60px">
                <select name="jednotka_f1">
                    <option value="mN">mN</option>
                    <option value="N">N</option>
                    <option value="kN">kN</option>
                    <option value="MN">MN</option>
                </select>
                r1=<input type="text" onkeypress="isInputNumber(event)" name="r1" style="width: 60px">
                <select name="jednotka_r1">
                    <option value="mm">mm</option>
                    <option value="cm">cm</option>
                    <option value="dm">dm</option>
                    <option value="m">m</option>
                    <option value="km">km</option>
                </select>
                 = 
                F2=<input type="text" onkeypress="isInputNumber(event)" name="f2" style="width: 60px">
                <select name="jednotka_f2">
                    <option value="mN">mN</option>
                    <option value="N">N</option>
                    <option value="kN">kN</option>
                    <option value="MN">MN</option>
                </select>
                r2=<input type="text" onkeypress="isInputNumber(event)" name="r2" style="width: 60px">
                <select name="jednotka_r2">
                    <option value="mm">mm</option>
                    <option value="cm">cm</option>
                    <option value="dm">dm</option>
                    <option value="m">m</option>
                    <option value="km">km</option>
                </select>
                <button type="submit" name="submit_sila">=</button>
                <br>
                <br>
                <div>'. $this->sila() .' </div>
                <br>
                <br>
                <h1>Chémia</h1>
                <br>
                <br>
                <h2>Hmotnostný zlomok</h2>
                <br>
                <div class="kaukulacka">
                    m(A)=<input type="text" onkeypress="isInputNumber(event)" name="ma" style="width: 60px">
                    <select name="jednotka_ma">
                        <option value="mg">mg</option>
                        <option value="g">g</option>
                        <option value="dkg">dkg</option>
                        <option value="kg">kg</option>
                        <option value="q">q</option>
                        <option value="t">t</option>
                    </select>
                </div>
                <br>
                <br>
                <div class="kaukulacka">
                    m(R)=<input type="text" onkeypress="isInputNumber(event)" name="mr" style="width: 60px">
                    <select name="jednotka_mr">
                        <option value="mg">mg</option>
                        <option value="g">g</option>
                        <option value="dkg">dkg</option>
                        <option value="kg">kg</option>
                        <option value="q">q</option>
                        <option value="t">t</option>
                    </select>
                </div>
                <br>
                <br>
                <div class="kaukulacka">
                    m(B)=<input type="text" onkeypress="isInputNumber(event)" name="m(b)" style="width: 60px">
                    <select name="jednotka_mb">
                        <option value="mg">mg</option>
                        <option value="g">g</option>
                        <option value="dkg">dkg</option>
                        <option value="kg">kg</option>
                        <option value="q">q</option>
                        <option value="t">t</option>
                    </select>
                </div>
                <br>
                <br>
                <div class="kaukulacka">
                    w=<input type="text" onkeypress="isInputNumber(event)" name="w" style="width: 60px">
                    %
                </div>
                <br>
                <br>
                <button type="submit" name="submit_h_zlomok">=</button>
                <select name="jednotka_h_z">
                    <option value="%">%</option>
                    <option value="mg">mg</option>
                    <option value="g">g</option>
                    <option value="dkg">dkg</option>
                    <option value="kg">kg</option>
                    <option value="q">q</option>
                    <option value="t">t</option>
                </select>
                <div>'. $this->hmotnostny_zlomok() .'</div>
            </form>
            </div>
            <div class="rightbox">   
            </div>
        ';

        $theme->render($content);
    }

    #_______________________________________________

    
    public function chcem_cislo($number){
        if (!is_numeric($number))
            return false;
        $n = $number;
        $a = [];
        while((int)($n) > 0){
            $a[] = $n%10;
            $n /= 10;
        }
        $a = array_reverse($a);
        return $a;
    }
    public function del(){
        if (!isset($_POST['submit_del']))
            return '';
        $cislo = $_POST['1cislo'];
        $delitel = $_POST['2cislo'];
        if (empty($cislo))
            return '';
        if (empty($delitel))
            return '';
        $a = $this->chcem_cislo($cislo);
        $postup = $cislo . " : " . $delitel;
        $pocitanie = "";
        $vysledik = "";
        foreach ($a as $num){
            $counter = 0;
            $pocitanie .= $num;
            $postup1 .= "<br>". $pocitanie;
            while ($pocitanie >= $delitel){
                $pocitanie = $pocitanie - $delitel;
                $counter++;
            }
            $vysledik .= $counter;
        }
        if ($pocitanie != 0){
            $vysledik .= ".";
            $p5 = 5;
            while ($p5) {
                $counter = 0;
                $p5--;
                $pocitanie = $pocitanie * 10;
                $postup1 .= "<br>". $pocitanie;
                while ($pocitanie >= $delitel){
                    $pocitanie = $pocitanie - $delitel;
                    $counter++;
                }
                $vysledik .= $counter;
            }
        }
        $postup .= " = " . $vysledik;
        $postup .= $postup1;
        return $postup;
    }
    public function nasob(){
        if (!isset($_POST['submit_nasob']))
            return '';
        $cislo = $_POST['3cislo'];
        $krat = $_POST['4cislo'];
        if (empty($cislo))
            return '';
        if (empty($krat))
            return '';
        $a = $this->chcem_cislo($krat);
        $a = array_reverse($a);
        $counter = 0;
        foreach ($a as $num) {
            $pocitanie = $num * $cislo;
            if ($counter){
                $counter++;
                $postup .= "\n" . $pocitanie;
                $pocitanie2 = $pocitanie * 10;
                $pocitam_vysledok = $pocitam_vysledok + $pocitanie2;
            }
            else {
                $counter++;
                $postup .= $pocitanie;
                $pocitam_vysledok = $pocitanie;
            }
        }
        $vysledok = $pocitam_vysledok;
        $toto = $postup . "\n=" . $vysledok;
        return $toto;
    }
    public function premen_dlzka($a, $jednotky, $jednotkaa){
        if (empty($a))
            return false;
        // zakladna jednotka = "dm"
        $premenne_data = [
            "mm" => 100,
            "cm" => 10,
            "dm" => 1,
            "m" => 0.1,
            "km" => 0.001
        ];
        if (!(array_key_exists($jednotkaa, $premenne_data))){
            return false;
        }
        if (!(array_key_exists($jednotky, $premenne_data))){
            return false;
        }
        $menim = $a / $premenne_data[$jednotkaa];
        $return = $menim * $premenne_data[$jednotky];
        return $return;    
    }
    public function premen_hmotnost($m, $jednotky, $jednotka_hmotnosti){
        if (empty($m))
            return false;
        // zakladna jednotka = "kg"
        $premenne_data = [
            "mg" => 1000,
            "g" => 100,
            "dkg" => 10,
            "kg" => 1,
            "q" => 0.01,
            "t" => 0.001
        ];
        if (!(array_key_exists($jednotka_hmotnosti, $premenne_data))){
            return "niee";
        }
        if (!(array_key_exists($jednotky, $premenne_data))){
            return "nie";
        }
        $menim = $m / $premenne_data[$jednotka_hmotnosti];
        return $menim * $premenne_data[$jednotky];    
    }
    public function premen_objem($v, $jednotky, $jednotka_objem){
        if (empty($v))
            return false;
        // zakladna jednotka = "dm"
        $premenne_data = [
            "mm" => 10000,
            "cm" => 1000,
            "dm" => 1,
            "m" => 0.001,
            "km" => 0.000001,
            "ml" => 1000,
            "cl" => 100,
            "dcl" => 10,
            "l" => 1,
            "hl" => 0.01
        ];
        if (!(array_key_exists($jednotka_objem, $premenne_data))){
            return "niee";
        }
        if (!(array_key_exists($jednotky, $premenne_data))){
            return "nie";
        }
        $menim = $v / $premenne_data[$jednotka_objem];
        return $menim * $premenne_data[$jednotky];
    }
    public function premena_c($c, $jednotky, $jednotkac){
        if (empty($c))
            return false;
        // zakladna jednotka = "J"
        $premenne_data = [
            "mJ" => 1000,
            "J" => 1,
            "kJ" => 0.001,
            "GJ" => 0.000001,
            "MJ" => 0.000000001,
            "TJ" => 0.000000000001
        ];
        if (!(array_key_exists($jednotkac, $premenne_data))){
            return "niee";
        }
        if (!(array_key_exists($jednotky, $premenne_data))){
            return "nie";
        }
        $menim = $c / $premenne_data[$jednotkac];
        return $menim * $premenne_data[$jednotky];
    }
    public function premena_newton($f, $jednotky, $jednotkaf){
        if (empty($f))
            return false;
        // zakladna jednotka = "N"
        $premenne_data = [
            "mN" => 1000,
            "N" => 1,
            "kN" => 0.001,
            "MN" => 0.000001
        ];
        if (!(array_key_exists($jednotkaf, $premenne_data))){
            return "niee";
        }
        if (!(array_key_exists($jednotky, $premenne_data))){
            return "nie";
        }
        $menim = $f / $premenne_data[$jednotkaf];
        return $menim * $premenne_data[$jednotky];
    }
    public function trojuholnik(){
        if (!isset($_POST['submit_trojuholnik']))
            return '';
        $return = "";
        $a = $_POST['trojuholnik_a'];
        $b = $_POST['trojuholnik_b'];
        $va = $_POST['trojuholnik_va'];
        $s = $_POST['trojuholnik_s'];
        $jednotky = $_POST['jednotky_trojuholnika'];
        $a = $this->premen_dlzka($a, $jednotky, $_POST['jednotka_trojuholnik_a']);
        if (isset($_POST['obsah_thojuholnika'])){
            if (!empty($a) && !empty($b) && empty($va)){
                $b = $this->premen_dlzka($b, $jednotky, $_POST['jednotka_trojuholnik_b']);
                $postup = $a * $b;
                $vysledik = $postup / 2;
                $return .= "
                <br>
                S= a . b : 2
                <br>
                S= ".  $a . " . " . $b . " : 2
                <br>
                S= " . $postup . " : 2
                <br>
                S= " . $vysledik . " " . $jednotky . "2";
            }
            elseif(!empty($a) && !empty($va)) {
                $va = $this->premen_dlzka($va, $jednotky, $_POST['jednotka_trojuholnik_va']);
                $postupok = $a * $va;
                $vysledik = $postupok / 2;
                $return .= "
                <br>
                S= a . Va : 2
                <br>
                S= ".  $a . " . " . $va . " : 2
                <br>
                S= " . $postupok . " : 2
                <br>
                S= " . $vysledik . " " . $jednotky . "2";
            }
        }
        if (isset($_POST['cislo3'])){
            if(!empty($va) and !empty($s) empty($a)){
                $va = $this->premen_dlzka($va, $_POST['jednotka_trojuholnik_s'], $_POST['jednotka_trojuholnik_va']);
                $postupok = 2 * $s;
                $a = $postupok / $va;
                $a = $this->premen_dlzka($a, $jednotky, $_POST['jednotka_trojuholnik_s']);
                $return .= "
                <br>
                a= 2 . s : Va
                <br>
                a= 2 . ".  $s . " : " . $va . "
                <br>
                a= " . $postupok . " : ". $va ."
                <br>
                a= " . $a . " " . $jednotky . "";
            }
            elseif(!empty($a) and !empty($s) empty($va)){
                $a = $this->premen_dlzka($aa, $_POST['jednotka_trojuholnik_s'], $_POST['jednotka_trojuholnik_a']);
                $postupok = 2 * $s;
                $a = $postupok / $a;
                $a = $this->premen_dlzka($a, $jednotky, $_POST['jednotka_trojuholnik_s']);
                $return .= "
                <br>
                Va= 2 . s : a
                <br>
                Va= 2 . ".  $s . " : " . $a . "
                <br>
                Va= " . $postupok . " : ". $a ."
                <br>
                Va= " . $va . " " . $jednotky . "";
            }
        }
        return $return;
    }
    public function obsah_povrch_3strana(){
        if (!isset($_POST['submit_obsah']))
            return '';
        $return = "";
        //identifikacia cisiel a jednotiek
        $a = $_POST['5cislo'];
        $b = $_POST['6cislo'];
        $c = $_POST['7cislo'];
        $v = $_POST['objem'];
        $jednotky = $_POST['jednotky'];
        $a = $this->premen_dlzka($a, $jednotky, $_POST['jednotkaa']);
        $b = $this->premen_dlzka($b, $jednotky, $_POST['jednotkab']);
        $c = $this->premen_dlzka($c, $jednotky, $_POST['jednotkac']);
        $v = $this->premen_objem($v, $jednotky, $_POST['jednotka3']);
        if (isset($_POST['obsah'])){
            //pocitanoe obsahu kocky
            if (empty($b) && empty($c)){
                $postup = $a * $a;
                $vysledik = $postup * $a;
                $return .= "
                <br>
                V= a . a . a 
                <br>
                V= ".  $a . " . " . $a . " . " . $a . "
                <br>
                V= " . $postup . " . " . $a . "
                <br>
                V= " . $vysledik . " " . $jednotky . "³";
            }
            else {
                //pocitanie obsahu kvadra
                $postupok = $a * $b;
                $vysledik = $postupok * $c;
                $return .= "
                <br>
                V= a . b . c 
                <br>
                V= ".  $a . " . " . $b . " . " . $c . "
                <br>
                V= " . $postupok . " . " . $c . "
                <br>
                V= " . $vysledik . " " . $jednotky . "³";
            }
        }
        if (isset($_POST['povrch'])) {
            //pocitanie povrchu kocky
            if (empty($b) && empty($c)){
                $postupik = $a * $a;
                $vysledik = $postupik * 6;
                $return .="
                <br>
                S= 6 . a . a 
                <br>
                S= 6 . " . $a . " . " . $a . "
                <br>
                S= 6 . " . $postupik . "
                <br>
                S= " . $vysledik .  " " . $jednotky . "²";
            }
            else {
                //pocitanie povrchu kvadra
                $postup1 = $a * $b;
                $postup2 = $a * $c;
                $postup3 = $b * $c;
                $postup4 = 2 * $postup1;
                $postup5 = 2 * $postup2;
                $postup6 = 2 * $postup3;
                $vysledik = $postup4 + $postup5 + $postup6;
                $return .= "
                <br>
                S= 2 . a . c + 2 . a . c + 2 . b . c 
                <br>
                S= 2 . " . $a . " . " . $b . " + 2 . " . $a . " . " . $c . " + 2 . " . $b . " . " . $c . "
                <br>
                S= 2 . " . $postup1 . " + 2 . " . $postup2 . " + 2 . " . $postup3 . "
                <br>
                S= " . $postup4 . " + " . $postup5 . " + " . $postup6 . "
                <br>
                S= " . $vysledik . " " . $jednotky . "²";
            }
        }
        if (isset($_POST['3strana'])) {
            if (empty($b)) {
                $b = $a;
            }
            $vypocet = $a * $b;
            $vypocet2 = $v / $vypocet;
            $return .= "
            <br>
            V= a . b . c
            <br>
            V= ". $a ." . ". $b ." . c
            <br>
            V= ". $vypocet ." . c
            <br>
            c= ". $v ." : ". $vypocet ."
            <br>
            c= ". $vypocet2 ." ". $jednotky ." ";
        }
        return $return;
    }
    public function zmen_v_pomere() {
        if (!isset($_POST['submit_zmen_v_pomere'])) {
            return '';
        }
        $c1 = $_POST['pomer_cislo1'];
        $c2 = $_POST['pomer_cislo2'];
        $c3 = $_POST['pomer_cislo3'];
        $postup = $c1 / $c3;
        $vysledok = $postup * $c2;
        return "
        <br>
        X= ". $c1 ." : ". $c3 ." . ". $c2 ."
        <br>
        X= ". $postup ." . ". $c2 ."
        <br>
        X= ". $vysledok ."
        ";
    }
    public function rozdel_v_pomere() {
        if (!isset($_POST['submit_rozdel_v_pomere'])) {
            return '';
        }
        $c4 = $_POST['pomer_cislo4'];
        $c5 = $_POST['pomer_cislo5'];
        $c6 = $_POST['pomer_cislo6'];
        $c7 = $_POST['pomer_cislo7'];
        if (empty($c7)) {
            $postup = $c5 + $c6;
            $postup1 = $c4 / $postup;
            $vysledok1 = $postup1 * $c5;
            $vysledok2 = $postup1 * $c6;
            return "
            <br>
            X= ". $c5 ." + ". $c6 ."
            <br>
            X= ". $c4 ." : ". $postup ."
            <br> 
            X= ". $vysledok1 ." : ". $vysledok2 ." (výsledok)
            ";
        }
        else {
            $postup = $c5 + $c6 + $c7;
            $postup1 = $c4 / $postup;
            $vysledok1 = $postup1 * $c5;
            $vysledok2 = $postup1 * $c6;
            $vysledok3 = $postup1 * $c7;
            return "
            <br>
            X= ". $c5 ." + ". $c6 ." + ". $c7 ."
            <br>
            X= ". $c4 ." : ". $postup ."
            <br> 
            X= ". $vysledok1 ." : ". $vysledok2 ." : ". $vysledok3 ." (výsledok)
            ";
        }
    }
    public function percenta() {
        if (!isset($_POST['submit_percenta']))
            return '';
        $z = $_POST['percenta_cisloz'];
        $p = $_POST['percenta_cislop'];
        $c = $_POST['percenta_cisloc'];
        if (empty($c) and !empty($z) and !empty($p)) {
            $postup = $z / 100;
            $c = $postup * $p;
            return "
            <br>
            1%.....". $z ." : 100 = ". $postup ."
            <br>
            ". $p ."%......". $postup ." . ". $p ." = ". $c ."
            ";
        }
        elseif (empty($p) and !empty($z) and !empty($c)) {
            $postup = $z / 100;
            $p = $c / $postup;
            return "
            <br>
            1%.....". $z ." : 100 = ". $postup ."
            <br>
            x%.......". $c ." : ". $postup ." = ". $p ."
            ";
        }
        elseif (empty($z) and !empty($p) and !empty($c)) {
            $postup = $c / $p;
            $z = $postup * 100;
            return "
            <br>
            1%.....". $c ." : ". $p ." = ". $postup ."
            <br>
            100%...". $postup ." . 100 = ". $z ."
            ";
        }
    }
    public function povrch_hranol() {
        if (!isset($_POST['submit_hranol']))
            return '';
        $return ="";
        $a = $_POST['hranola'];
        $b = $_POST['hranolb'];
        $va = $_POST['hranolva'];
        $vh = $_POST['vh'];
        $hranol = $_POST['hranol'];
        $jednotky = $_POST['jednotkavysledok'];
        $a = $this->premen_dlzka($a, $jednotky, $_POST['jednotkahranola']);
        $vh = $this->premen_dlzka($vh, $jednotky, $_POST['jednotkavh']);
        if($hranol == 4 and empty($va)){
            $sp = $a * $a;
            $return .= "
                <br>
                Sp= a . a
                <br>
                Sp= ". $a ." . ". $a ."
                <br>
                Sp= ". $sp ." ". $jednotky ."2
                <br>";
        }
        elseif($hranol == 4 and !empty($b)){
            $b = $this->premen_dlzka($b, $jednotky, $_POST['jednotkahranolvab']);
            $sp = $a * $b;
            $return .= "
            <br>
            Sp= a . b
            <br>
            Sp= ". $a ." . ". $b ."
            <br>
            Sp= ". $sp ." ". $jednotky ."2
            <br>";
        }
        elseif($hranol == 4 and !empty($va)){
            $va = $this->premen_dlzka($va, $jednotky, $_POST['jednotkahranolva']);
            $sp = $a * $va;
            $return .= "
            <br>
            Sp= a . Va
            <br>
            Sp= ". $a ." . ". $va ."
            <br>
            Sp= ". $sp ." ". $jednotky ."2
            <br>";
        }
        elseif($hranol == 3 and !empty($b)){
            $b = $this->premen_dlzka($b, $jednotky, $_POST['jednotkahranolvab']);
            $vypocet = $a * $b;
            $sp = $vypocet / 2;
            $return .= "
            <br>
            Sp= a . b : 2
            <br>
            Sp= ". $a ." . ". $b ." : 2
            <br>
            Sp= ". $vypocet ." : 2
            <br>
            Sp= ". $sp ." ". $jednotky ."2
            <br>";
        }
        elseif($hranol == 3 and !empty($va)){
            $va = $this->premen_dlzka($va, $jednotky, $_POST['jednotkahranolva']);
            $vypocet = $a * $va;
            $sp = $vypocet / 2;
            $return .= "
            <br>
            Sp= a . Va : 2
            <br>
            Sp= ". $a ." . ". $va ." : 2
            <br>
            Sp= ". $vypocet ." : 2
            <br>
            Sp= ". $sp ." ". $jednotky ."2
            <br>";
        }
        if (isset($_POST['hranol_povrch'])){
            $spl = $hranol * $a * $vh;
            $s = 2 * $sp + $spl;
            $return .= "
                <br>
                Spl= ". $hranol ." . a . Vh
                <br>
                Spl= ". $hranol ." . ". $a ." . ". $vh ."
                <br>
                Spl= ". $spl ." ". $jednotky ."2
                <br>
                S= 2 . Sp + Spl
                <br>
                S= 2 . ". $sp ." + ". $spl ."
                <br>
                S= ". $s ." ". $jednotky ."2
                <br>";
        }
        if (isset($_POST['hranol_obsah'])){
            $v = $sp * $vh;
            $return .= "
                <br>
                V= Sp . Vh
                <br>
                V= ". $sp ." . ". $vh ."
                <br>
                V= ". $v ." ". $jednotky ."3
                <br>";
        }
        
        return $return;
    }
    public function hustota() {
        if (!isset($_POST['submit_hustota']))
            return '';
        $return = "";
        $m = $_POST['hmotnost'];
        $v = $_POST['objemfyz'];
        $ro = $_POST['roo'];
        $jednotka_ro = $_POST['jednotka_ro'];
        if ($jednotka_ro == "kg/m³") {
            $jednotka_hmotnosti = "kg";
            $jednotka_objem = "m";
        }
        else{
            $jednotka_hmotnosti = "g";
            $jednotka_objem = "cm";
        }
        $m = $this->premen_hmotnost($m, $jednotka_hmotnosti, $_POST['jednotka_hmotnosti']);
        $v = $this->premen_objem($v, $jednotka_objem, $_POST['jednotka_objem']);
        if (empty($ro) and !empty($m) and !empty($v)) {
            $vysledok = $m / $v;
            $return .= "
            <br>
            ρ= m : V
            <br>
            ρ= ". $m ." : ". $v ."
            <br>
            ρ= ". $vysledok ." ". $jednotka_ro ."
            ";
        }
        elseif (empty($m) and !empty($ro) and !empty($v)){
            $vysledik = $ro * $v;
            $return .= "
            <br>
            m= ρ . V
            <br>
            m= ". $ro ." . ". $v ."
            <br>
            m= ". $vysledik ." ". $jednotka_hmotnosti ."
            ";
        }
        elseif (empty($v) and !empty($m) and !empty($ro)) {
            $vysledik = $m / $ro;
            $return .= "
            <br>
            V= m : ρ
            <br>
            V= ". $m ." : ". $ro ."
            <br>
            V= ". $vysledik ."
            ";
        }
        return $return;
    }
    public function teplo() {
        if (!isset($_POST['submit_teplo']))
            return '';
        $m = $_POST['hmotnost1'];
        $deltat = $_POST['deltat'];
        $c = $_POST['cisloc'];
        $q = $_POST['teplo'];
        $m = $this->premen_hmotnost($m, "kg", $_POST['jednotka_hmotnosti1']);
        $jednotkac = $_POST['jednotkac'];
        if (empty($q) and !empty($c) and !empty($deltat) and !empty($m)) {
            $q = $m * $c *$deltat;
            return "
            <br>
            Q= m . c . <|t
            <br>
            Q= ". $m ." . ". $c ." . ". $deltat ."
            <br>
            Q= ". $q ." ". $jednotkac ."
            ";
        }
        elseif (empty($c) and !empty($m) and !empty($deltat) and !empty($q)) {
            $postup = $m * $deltat;
            $vysledik = $q / $postup;
            return "
            <br>
            c= Q : (m . <|t)
            <br>
            c= ". $q ." : (". $m ." . ". $deltat .")
            <br>
            c= ". $q ." : ". $postup ."
            <br>
            c= ". $vysledik ." ". $_POST['jednotka_teplo'] ."/kg ºC
            ";
        }
        elseif (empty($m) and !empty($c) and !empty($deltat) and !empty($q)) {
            $postup1 = $c * $deltat;
            $m = $q / $postup1;
            return "
            <br>
            m= Q : (c . <|t)
            <br>
            m= ". $q ." : (". $c ." . ". $deltat .")
            <br>
            m= ". $q ." : ". $postup1 ."
            <br>
            m= ". $m ." kg
            ";
        }
        elseif (empty($deltat) and !empty($c) and !empty($m) and !empty($q)) {
            $postup2 = $c * $m;
            $vysledik1 = $q / $postup2;
            return "
            <br>
            <|t= Q : (c . m)
            <br>
            <|t= ". $q ." : (". $c ." . ". $m .")
            <br>
            <|t= ". $q ." : ". $postup2 ."
            <br>
            <|t= ". $vysledik1 ." ºC
            ";
        }
    }
    public function sila() {
        if (!isset($_POST['submit_sila']))
            return '';
        $f1 = $_POST['f1'];
        $f2 = $_POST['f2'];
        $r1 = $_POST['r1'];
        $r2 = $_POST['r2'];
        /*$f1 = $this->premena_newton($f1, "N", $_POST['jednotka_f1']);
        $f2 = $this->premena_newton($f2, "N", $_POST['jednotka_f2']);
        $r1 = $this->premen_dlzka($r1, "m", $_POST['jednotka_r1']);
        $r2 = $this->premen_dlzka($r2, "m", $_POST['jednotka_r2']);*/
        if (empty($f2) and !empty($r1) and !empty($r2) and !empty($f1)) {
            $r1 = $this->premen_dlzka($r1, "m", $_POST['jednotka_r1']);
            $r2 = $this->premen_dlzka($r2, "m", $_POST['jednotka_r2']);
            $f1 = $this->premena_newton($f1, "N", $_POST['jednotka_f1']);
            $pocitam = $f1 * $r1;
            $pocitam1 = $pocitam / $r2;
            return "
            <br>
            F1 . r1 = F2 . r2
            <br>
            ". $f1 ." . ". $r1 ." = F2 . ". $r2."
            <br>
            ". $pocitam ." = F2 . ". $r2."
            <br>
            ". $pocitam ." : ". $r2 ."
            <br>
            F2 = ". $pocitam1 ." N
            <br>
            ";
        }
        elseif (empty($r2) and !empty($r1) and !empty($f2) and !empty($f1)) {
            $r1 = $this->premen_dlzka($r1, "m", $_POST['jednotka_r1']);
            $f1 = $this->premena_newton($f1, "N", $_POST['jednotka_f1']);
            $f2 = $this->premena_newton($f2, "N", $_POST['jednotka_f2']);
            $pocitam = $f1 * $r1;
            $pocitam1 = $pocitam / $f2;
            return "
            <br>
            F1 . r1 = F2 . r2
            <br>
            ". $f1 ." . ". $r1 ." = ". $f2 ." . r2
            <br>
            ". $pocitam ." = ". $f2 ." . r2
            <br>
            ". $pocitam ." : ". $f2 ."
            <br>
            r2 = ". $pocitam1 ." m
            <br>
            ";
        }
        elseif (empty($f1) and !empty($r1) and !empty($f2) and !empty($r2)) {
            $r1 = $this->premen_dlzka($r1, "m", $_POST['jednotka_r1']);
            $r2 = $this->premen_dlzka($r2, "m", $_POST['jednotka_r2']);
            $f2 = $this->premena_newton($f2, "N", $_POST['jednotka_f2']);
            $pocitam = $f2 * $r2;
            $pocitam1 = $pocitam / $r1;
            return "
            <br>
            F1 . r1 = F2 . r2
            <br>
            F1 . ". $r1 ." = ". $f2 ." . ". $r2 ."
            <br>
            F1 . ". $r1 ." = ". $pocitam ."
            <br>
            ". $pocitam ." : ". $r1 ."
            <br>
            F1 = ". $pocitam1 ." m
            <br>
            ";
        }
        elseif (empty($r1) and !empty($r2) and !empty($f2) and !empty($f1)) {
            $r2 = $this->premen_dlzka($r2, "m", $_POST['jednotka_r2']);
            $f1 = $this->premena_newton($f1, "N", $_POST['jednotka_f1']);
            $f2 = $this->premena_newton($f2, "N", $_POST['jednotka_f2']);
            $pocitam = $f2 * $r2;
            $pocitam1 = $pocitam / $f1;
            return "
            <br>
            F1 . r1 = F2 . r2
            <br>
            ". $f1 ." . r1 = ". $f2 ." . ". $r2 ."
            <br>
            ". $f1 ." . r1 = ". $pocitam ."
            <br>
            ". $pocitam ." : ". $f1 ."
            <br>
            r1 = ". $pocitam1 ." m
            <br>
            ";
        }
    }
    public function hmotnostny_zlomok() {
        if (!isset($_POST['submit_h_zlomok']))
            return '';
        $return = "";
        $ma = $_POST['ma'];
        $mr = $_POST['mr'];
        $mb = $_POST['m(b)'];
        $w = $_POST['w'];
        $jednotka_hmotnosti = $_POST['jednotka_h_z'];
        if ($jednotka_hmotnosti == "%") {
            if (empty($mr) and !empty($ma) and !empty($mb)) {
                $mb = $this->premen_hmotnost($mb, $_POST['jednotka_ma'], $_POST['jednotka_mb']);
                $mr = $ma + $mb;
                $return .= "
                <br>
                m(R)= m(A) + m(B)
                <br>
                m(R)= ". $ma ." + ". $mb."
                <br>
                m(R)= ". $mr ." ". $_POST['jednotka_ma'] ."
                <br>
                ";
            }
            if (empty($ma) and !empty($mr) and !empty($mb)) {
                $mb = premen_hmotnost($mb, $_POST['jednotka_mr'], $_POST['jednotka_mb']);
                $ma = $mr - $mb;
                $return .= "
                <br>
                m(A)= m(R) - m(B)
                <br>
                m(A)= ". $mr ." - ". $mb ."
                <br>
                m(A)= ". $ma ." ". $_POST['jednotka_mr'] ."
                <br>
                ";
            }
            $vypocet = $ma / $mr;
            $w = $vypocet * 100;
            $return .= "
            <br>
            w= m(A) : m(R)
            <br>
            w= ". $ma ." : ". $mr ."
            <br>
            w= ". $vypocet ." . 100
            <br>
            w= <b>". $w ." %</b>
            <br>
            ";
        }
        $ma = $this->premen_hmotnost($ma, $jednotka_hmotnosti, $_POST['jednotka_ma']);
        $mr = $this->premen_hmotnost($mr, $jednotka_hmotnosti, $_POST['jednotka_mr']);
        $mb = $this->premen_hmotnost($mb, $jednotka_hmotnosti, $_POST['jednotka_mb']);
        $w = $w / 100;
        if (empty($mr) and !empty($ma) and !empty($mb)) {
            $mr = $ma + $mb;
            $return .= "
            <br>
            m(R)= m(A) + m(B)
            <br>
            m(R)= ". $ma ." + ". $mb."
            <br>
            m(R)= <b>". $mr ." ". $jednotka_hmotnosti ."</b>
            <br>
            ";
        }
        if (empty($ma) and !empty($w) and !empty($mr)) {
            $ma = $w * $mr;
            $return .= "
            <br>
            m(A)= w . m(R)
            <br>
            m(A)= ". $w ." . ". $mr ."
            <br>
            m(A)= <b>". $ma ." ". $jednotka_hmotnosti ."</b>
            <br>
            ";
            if (empty($mr)) {
                $mr = $ma + $mb;
                $return .= "
                <br>
                m(R)= m(A) + m(B)
                <br>
                m(R)= ". $ma ." + ". $mb."
                <br>
                m(R)= <b>". $mr ." ". $jednotka_hmotnosti ."</b>
                <br>
                ";
            }
        }
        if (empty($mb) and !empty($mr) and !empty($ma)) {
            $mb = $mr - $ma;
            $return .= "
            <br>
            m(B)= m(R) - m(B)
            <br>
            m(B)= ". $mr ." - ". $ma ."
            <br>
            m(B)= <b>". $mb ." ". $jednotka_hmotnosti ."</b>
            ";
        }
        if (empty($mr) and !empty($ma) and !empty($w)) {
            $mr = $ma / $w;
            $return .= "
            <br>
            m(R)= m(A) : w
            <br>
            m(R)= ". $ma ." : ". $w ."
            <br>
            m(R)= <b>". $mr ." ". $jednotka_hmotnosti ."</b>
            <br>
            ";
            if (empty($mb)) {
                $mb = $mr - $ma;
                $return .= "
                <br>
                m(B)= m(R) - m(B)
                <br>
                m(B)= ". $mr ." - ". $ma ."
                <br>
                m(B)= <b>". $mb ." ". $jednotka_hmotnosti ."</b>
                ";
            }
        }
        if (empty($ma) and !empty($w) and !empty($mb)) {
            $w = $w * 100;
            $postup = 100 - $w;
            $percento = $mb / $postup;
            $ma = $percento * $w;
            $return .= "
            <br>
            m(A)= 100 - ". $w ."
            <br>
            m(A)= ". $postup ." %
            <br>
            m(A)= ". $mb ." : ". $postup ."
            <br>
            m(A)= ". $percento ."
            <br>
            m(A)= ". $percento ." . ". $w ."
            <br>
            m(A)= <b>". $ma ." ". $jednotka_hmotnosti ."</b>
            <br>
            ";
            if (empty($mr)) {
                $mr = $ma + $mb;
                $return .= "
                <br>
                m(R)= m(A) + m(B)
                <br>
                m(R)= ". $ma ." + ". $mb."
                <br>
                m(R)= <b>". $mr ." ". $jednotka_hmotnosti ."</b>
                <br>
                ";
            }
        }
        return $return;
    }
}