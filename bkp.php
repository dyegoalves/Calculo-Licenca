<?php
/**
 * Created by PhpStorm.
 * User: Dyego
 * Date: 10/09/2016
 * Time: 02:19
 */

class bkp {

    //Calculo2 funcao de apoio
    public function pequeno()
    {
        return "PEQUENO";
    }
    public function medio()
    {
        return "MEDIA";
    }
    public function grande()
    {
        return "GRANDE";
    }
    public function excepcional()
    {
        return "EXCEPCIONAL";
    }

    //Calculo1 porte funcionado ok
    public function calcularporte(){

        $atvidadecodido = Atividade::find(intval(Input::get("atividade")));
        $subatividadecodigo = Subatividade::find(intval(Input::get("subatividade")));

        $atvidadecodido =  trim($atvidadecodido->codigo);
        $subatividadecodigo = trim($subatividadecodigo->codigo);

        if($atvidadecodido == "03" && ($subatividadecodigo >= "0301" && $subatividadecodigo <= "0352")){

            $au  = Input::get("areaultiu");
            $ne  = Input::get("numerodeempregados");

            // tab = atv03  ; col = 1 ; lin = 1 // au = 0.1 ate 0.9 ne = de 0.1 a 99.9

            if($au < 1 && $ne < 100){
                $porte = "P";
                return $porte;
            }
            // tab = atv03   ; col = 1 ; lin = 2 // au = 0.1 ate 0. 9 ne = de 100 ate 300
            if( $au < 1 && ($ne >= 100 && $ne <= 300) ){
                $porte = "M";
                return $porte;
            }
            // tab = atv03   ; col = 1 ; lin = 3 // au = 0.1 ate 0. 9 ne = de 301 ate 899
            if( $au < 1 && ($ne > 300 && $ne < 900) ){
                $porte = "G";
                return $porte;
            }
            // tab = atv03   ; col = 1 ; lin = 4 // au = 0.1 ate 0. 9 ne = 900++
            if( $au < 1 && ($ne >= 900) ){
                $porte = "E";
                return $porte;
            }
            // tab = atv03   ; col = 2 ; lin = 1 // au = 1 ate 2 ne = 99
            if(($au >= 1 && $au <= 2 )  && $ne < 100){
                $porte = "M";
                return $porte;
            }
            // tab = atv03   ; col = 2 ; lin = 2 // au = 1 ate 2 ne = 100 ate 300
            if(($au >= 1 && $au <= 2 ) && ($ne >= 100 && $ne <= 300) ){
                $porte = "M";
                return $porte;
            }
            // tab = atv03   ; col = 2 ; lin = 3 // au = 1 ate 2 ne = 301 ate 899
            if(($au >= 1 && $au <= 2 ) && ($ne > 300 && $ne < 900) ){
                $porte = "G";
                return $porte;
            }
            // tab = atv03   ; col = 2 ; lin = 4 // au = 1 ate 2 ne = 900++
            if(($au >= 1 && $au <= 2 ) && ($ne >= 900) ){
                $porte = "E";
                return $porte;
            }
            // tab = atv03   ; col = 3 ; lin = 1 // au = 2.1 ate 2.99 ne = 99
            if(($au > 2 && $au < 3 )  && $ne < 100){
                $porte = "G";
                return $porte;
            }
            // tab = atv03   ; col = 3 ; lin = 2 // au = 2.1 ate 2.99 ne = 100 ate 300
            if(($au > 2 && $au < 3 ) && ($ne >= 100 && $ne <= 300) ){
                $porte = "G";
                return $porte;
            }
            // tab = atv03   ; col = 3 ; lin = 3 // au = 2.1 ate 2.99 ne = 301 ate 899
            if(($au > 2 && $au < 3 ) && ($ne > 300 && $ne < 900) ){
                $porte = "G";
                return $porte;
            }
            // tab = atv03   ; col = 3 ; lin = 4  // au = 2.1 ate 2.99 ne = 900++
            if(($au > 2 && $au < 3 ) && ($ne >= 900) ){
                $porte = "E";
                return $porte;
            }
            // tab = atv03   ; col =4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
            if(($au >= 3 )  && $ne < 100){
                $porte = "E";
                return $porte;
            }
            // tab = atv03   ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
            if(($au >= 3 ) && ($ne >= 100 && $ne <= 300) ){
                $porte = "E";
                return $porte;
            }
            // tab = atv03   ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
            if(($au >= 3 ) && ($ne > 300 && $ne < 900) ){
                $porte = "E";
                return $porte;
            }
            // tab = atv03   ; col = 4 ; lin = 4  // au = 3++ ne = 900++
            if(($au >= 3 ) && ($ne >= 900) ){
                $porte = "E";
                return $porte;
            }
        }

        if($atvidadecodido == "04" && ($subatividadecodigo >= "0401" && $subatividadecodigo <= "0409")){
            $au  = $_GET['au'];
            $ne  = $_GET['ne'];
            // tab = atv04  ; col = 1 ; lin = 1 // au = 0.1 ate 0.9 ne = de 0.1 a 99.9
            if( $au < 1 && $ne < 100){
                $porte = "P";
                return $porte;
            }
            // tab = atv04  ; col = 1 ; lin = 2 // au = 0.1 ate 0. 9 ne = de 100 ate 300
            if( $au < 1 && ($ne >= 100 && $ne <= 300) ){
                $porte = "M";
                return $porte;
            }
            // tab = atv04  ; col = 1 ; lin = 3 // au = 0.1 ate 0. 9 ne = de 301 ate 899
            if( $au < 1 && ($ne > 300 && $ne < 900) ){
                $porte = "G";
                return $porte;
            }
            // tab = atv04  ; col = 1 ; lin = 4 // au = 0.1 ate 0. 9 ne = 900++
            if( $au < 1 && ($ne >= 900) ){
                $porte = "E";
                return $porte;
            }
            // tab = atv04  ; col = 2 ; lin = 1 // au = 1 ate 2 ne = 99
            if(($au >= 1 && $au <= 2 )  && $ne < 100){
                $porte = "M";
                return $porte;
            }
            // tab = atv04  ; col = 2 ; lin = 2 // au = 1 ate 2 ne = 100 ate 300
            if(($au >= 1 && $au <= 2 ) && ($ne >= 100 && $ne <= 300) ){
                $porte = "M";
                return $porte;
            }
            // tab = atv04  ; col = 2 ; lin = 3 // au = 1 ate 2 ne = 301 ate 899
            if(($au >= 1 && $au <= 2 ) && ($ne > 300 && $ne < 900) ){
                $porte = "G";
                return $porte;
            }
            // tab = atv04  ; col = 2 ; lin = 4 // au = 1 ate 2 ne = 900++
            if(($au >= 1 && $au <= 2 ) && ($ne >= 900) ){
                $porte = "E";
                return $porte;
            }
            // tab = atv04  ; col = 3 ; lin = 1 // au = 2.1 ate 2.99 ne = 99
            if(($au > 2 && $au < 3 )  && $ne < 100){
                $porte = "G";
                return $porte;
            }
            // tab = atv04  ; col = 3 ; lin = 2 // au = 2.1 ate 2.99 ne = 100 ate 300
            if(($au > 2 && $au < 3 ) && ($ne >= 100 && $ne <= 300) ){
                $porte = "G";
                return $porte;
            }
            // tab = atv04  ; col = 3 ; lin = 3 // au = 2.1 ate 2.99 ne = 301 ate 899
            if(($au > 2 && $au < 3 ) && ($ne > 300 && $ne < 900) ){
                $porte = "G";
                return $porte;
            }
            // tab = atv04  ; col = 3 ; lin = 4  // au = 2.1 ate 2.99 ne = 900++
            if(($au > 2 && $au < 3 ) && ($ne >= 900) ){
                $porte = "E";
                return $porte;
            }
            // tab = atv04  ; col = 4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
            if(($au >= 3 )  && $ne < 100){
                $porte = "E";
                return $porte;
            }
            // tab = atv04 ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
            if(($au >= 3 ) && ($ne >= 100 && $ne <= 300) ){
                $porte = "E";
                return $porte;
            }
            // tab = atv04  ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
            if(($au >= 3 ) && ($ne > 300 && $ne < 900) ){
                $porte = "E";
                return $porte;
            }
            // tab = atv04  ; col = 4 ; lin = 4  // au = 3++ ne = 900++
            if(($au >= 3 ) && ($ne >= 900) ){
                $porte = "E";
                return $porte;
            }
        }

        if($atvidadecodido == "05" && ($subatividadecodigo >= "0501" && $subatividadecodigo <= "0504")){
            $au  = $_GET['au'];
            $ne  = $_GET['ne'];
            // tab = atv05  ; col = 1 ; lin = 1 // au = 0.1 ate 0.9 ne = de 0.1 a 99.9
            if( $au < 0.2  && $ne < 100){
                $porte = "P";
                return $porte;
            }
            // tab = atv05  ; col = 1 ; lin = 2 // au = 0.1 ate 0. 9 ne = de 100 ate 300
            if( $au < 0.2  && ($ne >= 100 && $ne <= 300) ){
                $porte = "M";
                return $porte;
            }
            // tab = atv05  ; col = 1 ; lin = 3 // au = 0.1 ate 0. 9 ne = de 301 ate 899
            if( $au < 0.2  && ($ne > 300 && $ne < 900) ){
                $porte = "G";
                return $porte;
            }
            // tab = atv05  ; col = 1 ; lin = 4 // au = 0.1 ate 0. 9 ne = 900++
            if( $au < 0.2  && $ne >= 900 ){
                $porte = "E";
                return $porte;
            }
            // tab = atv05 ; col = 2 ; lin = 1 // au = 1 ate 2 ne = 99
            if(($au >= 0.2 && $au <= 1 )  && $ne < 100){
                $porte = "M";
                return $porte;
            }
            // tab = atv05  ; col = 2 ; lin = 2 // au = 1 ate 2 ne = 100 ate 300
            if(($au >= 0.2 && $au <= 1 ) && ($ne >= 100 && $ne <= 300) ){
                $porte = "M";
                return $porte;
            }
            // tab = atv05  ; col = 2 ; lin = 3 // au = 1 ate 2 ne = 301 ate 899
            if(($au >= 0.2 && $au <= 1 ) && ($ne > 300 && $ne < 900) ){
                $porte = "G";
                return $porte;
            }
            // tab = atv05  ; col = 2 ; lin = 4 // au = 1 ate 2 ne = 900++
            if(($au >= 0.2 && $au <= 1 )  && ($ne >= 900) ){
                $porte = "E";
                return $porte;
            }
            // tab = atv05  ; col = 3 ; lin = 1 // au = 1.1 ate 2.99 ne = 99
            if(($au > 1 && $au < 3 )  && $ne < 100){
                $porte = "G";
                return $porte;
            }
            // tab = atv05  ; col = 3 ; lin = 2 // au = 1.1 ate 2.99 ne = 100 ate 300
            if(($au > 1 && $au < 3 )  && ($ne >= 100 && $ne <= 300) ){
                $porte = "G";
                return $porte;
            }
            // tab = atv05  ; col = 3 ; lin = 3 // au = 1.1 ate 2.99 ne = 301 ate 899
            if(($au > 1 && $au < 3 )  && ($ne > 300 && $ne < 900) ){
                $porte = "G";
                return $porte;
            }
            // tab = atv05  ; col = 3 ; lin = 4  // au = 1.1 ate 2.99 ne = 900++
            if(($au > 1 && $au < 3 )  && ($ne >= 900) ){
                $porte = "E";
                return $porte;
            }
            // tab = atv05  ; col =4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
            if(($au >= 3 ) && $ne < 100){
                $porte = "E";
                return $porte;
            }
            // tab = atv05  ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
            if(($au >= 3 ) && ($ne >= 100 && $ne <= 300) ){
                $porte = "E";
                return $porte;
            }
            // tab = atv05  ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
            if(($au >= 3 ) && ($ne > 300 && $ne < 900) ){
                $porte = "E";
                return $porte;
            }
            // tab = atv05  ; col = 4 ; lin = 4  // au = 3++ ne = 900++
            if(($au >= 3 ) && ($ne >= 900) ){
                $porte = "E";
                return $porte;
            }
        }

        if($atvidadecodido == "06" && ($subatividadecodigo >= "0601" && $subatividadecodigo <= "0604")){
            $au  = $_GET['au'];
            $ne  = $_GET['ne'];
            // tab = atv06  ; col = 1 ; lin = 1 // au = 0.1 ate 0.9 ne = de 0.1 a 99.9
            if( $au < 1 && $ne < 100){
                $porte = "P";
                return $porte;
            }
            // tab = atv06  ; col = 1 ; lin = 2 // au = 0.1 ate 0. 9 ne = de 100 ate 200
            if( $au < 1 && ($ne >= 100 && $ne <= 200) ){
                $porte = "M";
                return $porte;
            }
            // tab = atv06  ; col = 1 ; lin = 3 // au = 0.1 ate 0. 9 ne = de 201 ate 499
            if( $au < 1 && ($ne > 200 && $ne < 500) ){
                $porte = "G";
                return $porte;
            }
            // tab = atv06  ; col = 1 ; lin = 4 // au = 0.1 ate 0. 9 ne = 500++
            if( $au < 1 && ($ne >= 500) ){
                $porte = "E";
                return $porte;
            }
            // tab = atv06  ; col = 2 ; lin = 1 // au = 1 ate 2 ne = 99
            if(($au >= 1 && $au <= 2 )  && $ne < 100){
                $porte = "M";
                return $porte;
            }
            // tab = atv06  ; col = 2 ; lin = 2 // au = 1 ate 2 ne = 100 ate 200
            if(($au >= 1 && $au <= 2 ) && ($ne >= 100 && $ne <= 200) ){
                $porte = "M";
                return $porte;
            }
            // tab = atv06  ; col = 2 ; lin = 3 // au = 1 ate 2 ne = 201 ate 499
            if(($au >= 1 && $au <= 2 ) && ($ne > 200 && $ne < 500) ){
                $porte = "G";
                return $porte;
            }
            // tab = atv06  ; col = 2 ; lin = 4 // au = 1 ate 2 ne = 500++
            if(($au >= 1 && $au <= 2 ) && ($ne >= 500) ){
                $porte = "E";
                return $porte;
            }

            // tab = atv06  ; col = 3 ; lin = 1 // au = 2 ate 4.99 ne = 99
            if(($au > 2 && $au < 5 )  && $ne < 100){
                $porte = "G";
                return $porte;
            }
            // tab = atv06  ; col = 3 ; lin = 2 // au = 2 ate 4.99 ne = 100 ate 300
            if(($au > 2 && $au < 5 ) && ($ne >= 100 && $ne <= 200) ){
                $porte = "G";
                return $porte;
            }
            // tab = atv06  ; col = 3 ; lin = 3 // au = 2 ate 4.99 ne = 301 ate 499
            if(($au > 2 && $au < 5 ) && ($ne > 200 && $ne < 500) ){
                $porte = "G";
                return $porte;
            }
            // tab = atv06  ; col = 3 ; lin = 4  // au = 2 ate 4.99 ne = 500++
            if(($au > 2 && $au < 5 ) && ($ne >= 500) ){
                $porte = "E";
                return $porte;
            }
            // tab = atv06  ; col =4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
            if(($au >= 5 )  && $ne < 100){
                $porte = "E";
                return $porte;
            }
            // tab = atv06  ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
            if(($au >= 5 ) && ($ne >= 100 && $ne <= 200) ){
                $porte = "E";
                return $porte;
            }
            // tab = atv06  ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
            if(($au >= 5 ) && ($ne > 200 && $ne < 500) ){
                $porte = "E";
                return $porte;
            }
            // tab = atv06  ; col = 4 ; lin = 4  // au = 3++ ne = 900++
            if(($au >= 5 ) && ($ne >= 500) ){
                $porte = "E";
                return $porte;
            }
        }
    }

    public function calcularporte2()

    {
        $atvidadecodido = Atividade::find(intval(Input::get("atividade")));
        $subatividadecodigo = Subatividade::find(intval(Input::get("subatividade")));
        $atvidadecodido = trim($atvidadecodido->codigo);
        $subatividadecodigo = trim($subatividadecodigo->codigo);
        if ($atvidadecodido == "03" && ($subatividadecodigo >= "0301" && $subatividadecodigo <= "0352"))
        {
            $au = Input::get("areaultiu");
            $ne = Input::get("numerodeempregados");
            // tab = atv03  ; col = 1 ; lin = 1 // au = 0.1 ate 0.9 ne = de 0.1 a 99.9
            if ($au < 1 && $ne < 100)
            {
                $porte = "PEQUENO";
                return $porte;
            }
            // tab = atv03   ; col = 1 ; lin = 2 // au = 0.1 ate 0. 9 ne = de 100 ate 300
            if ($au < 1 && ($ne >= 100 && $ne <= 300))
            {
                $porte = "MEDIO";
                return $porte;
            }
            // tab = atv03   ; col = 1 ; lin = 3 // au = 0.1 ate 0. 9 ne = de 301 ate 899
            if ($au < 1 && ($ne > 300 && $ne < 900))
            {
                $porte = "GRANDE";
                return $porte;
            }
            // tab = atv03   ; col = 1 ; lin = 4 // au = 0.1 ate 0. 9 ne = 900++
            if ($au < 1 && ($ne >= 900))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv03   ; col = 2 ; lin = 1 // au = 1 ate 2 ne = 99
            if (($au >= 1 && $au <= 2) && $ne < 100)
            {
                $porte = "MEDIO";
                return $porte;
            }
            // tab = atv03   ; col = 2 ; lin = 2 // au = 1 ate 2 ne = 100 ate 300
            if (($au >= 1 && $au <= 2) && ($ne >= 100 && $ne <= 300))
            {
                $porte = "MEDIO";
                return $porte;
            }
            // tab = atv03   ; col = 2 ; lin = 3 // au = 1 ate 2 ne = 301 ate 899
            if (($au >= 1 && $au <= 2) && ($ne > 300 && $ne < 900))
            {
                $porte = "GRANDE";
                return $porte;
            }
            // tab = atv03   ; col = 2 ; lin = 4 // au = 1 ate 2 ne = 900++
            if (($au >= 1 && $au <= 2) && ($ne >= 900))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv03   ; col = 3 ; lin = 1 // au = 2.1 ate 2.99 ne = 99
            if (($au > 2 && $au < 3) && $ne < 100)
            {
                $porte = "GRANDE";
                return $porte;
            }
            // tab = atv03   ; col = 3 ; lin = 2 // au = 2.1 ate 2.99 ne = 100 ate 300
            if (($au > 2 && $au < 3) && ($ne >= 100 && $ne <= 300))
            {
                $porte = "GRANDE";
                return $porte;
            }
            // tab = atv03   ; col = 3 ; lin = 3 // au = 2.1 ate 2.99 ne = 301 ate 899
            if (($au > 2 && $au < 3) && ($ne > 300 && $ne < 900))
            {
                $porte = "GRANDE";
                return $porte;
            }
            // tab = atv03   ; col = 3 ; lin = 4  // au = 2.1 ate 2.99 ne = 900++
            if (($au > 2 && $au < 3) && ($ne >= 900))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv03   ; col =4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
            if (($au >= 3) && $ne < 100)
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv03   ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
            if (($au >= 3) && ($ne >= 100 && $ne <= 300))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv03   ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
            if (($au >= 3) && ($ne > 300 && $ne < 900))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv03   ; col = 4 ; lin = 4  // au = 3++ ne = 900++
            if (($au >= 3) && ($ne >= 900))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
        }
        if ($atvidadecodido == "04" && ($subatividadecodigo >= "0401" && $subatividadecodigo <= "0409"))
        {
            $au = Input::get("areaultiu");
            $ne = Input::get("numerodeempregados");
            // tab = atv04  ; col = 1 ; lin = 1 // au = 0.1 ate 0.9 ne = de 0.1 a 99.9
            if ($au < 1 && $ne < 100)
            {
                $porte = "PEQUENO";
                return $porte;
            }
            // tab = atv04  ; col = 1 ; lin = 2 // au = 0.1 ate 0. 9 ne = de 100 ate 300
            if ($au < 1 && ($ne >= 100 && $ne <= 300))
            {
                $porte = "MEDIO";
                return $porte;
            }
            // tab = atv04  ; col = 1 ; lin = 3 // au = 0.1 ate 0. 9 ne = de 301 ate 899
            if ($au < 1 && ($ne > 300 && $ne < 900))
            {
                $porte = "GRANDE";
                return $porte;
            }
            // tab = atv04  ; col = 1 ; lin = 4 // au = 0.1 ate 0. 9 ne = 900++
            if ($au < 1 && ($ne >= 900))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv04  ; col = 2 ; lin = 1 // au = 1 ate 2 ne = 99
            if (($au >= 1 && $au <= 2) && $ne < 100)
            {
                $porte = "MEDIO";
                return $porte;
            }
            // tab = atv04  ; col = 2 ; lin = 2 // au = 1 ate 2 ne = 100 ate 300
            if (($au >= 1 && $au <= 2) && ($ne >= 100 && $ne <= 300))
            {
                $porte = "MEDIO";
                return $porte;
            }
            // tab = atv04  ; col = 2 ; lin = 3 // au = 1 ate 2 ne = 301 ate 899
            if (($au >= 1 && $au <= 2) && ($ne > 300 && $ne < 900))
            {
                $porte = "GRANDE";
                return $porte;
            }
            // tab = atv04  ; col = 2 ; lin = 4 // au = 1 ate 2 ne = 900++
            if (($au >= 1 && $au <= 2) && ($ne >= 900))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv04  ; col = 3 ; lin = 1 // au = 2.1 ate 2.99 ne = 99
            if (($au > 2 && $au < 3) && $ne < 100)
            {
                $porte = "GRANDE";
                return $porte;
            }
            // tab = atv04  ; col = 3 ; lin = 2 // au = 2.1 ate 2.99 ne = 100 ate 300
            if (($au > 2 && $au < 3) && ($ne >= 100 && $ne <= 300))
            {
                $porte = "GRANDE";
                return $porte;
            }
            // tab = atv04  ; col = 3 ; lin = 3 // au = 2.1 ate 2.99 ne = 301 ate 899
            if (($au > 2 && $au < 3) && ($ne > 300 && $ne < 900))
            {
                $porte = "GRANDE";
                return $porte;
            }
            // tab = atv04  ; col = 3 ; lin = 4  // au = 2.1 ate 2.99 ne = 900++
            if (($au > 2 && $au < 3) && ($ne >= 900))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv04  ; col = 4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
            if (($au >= 3) && $ne < 100)
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv04 ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
            if (($au >= 3) && ($ne >= 100 && $ne <= 300))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv04  ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
            if (($au >= 3) && ($ne > 300 && $ne < 900))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv04  ; col = 4 ; lin = 4  // au = 3++ ne = 900++
            if (($au >= 3) && ($ne >= 900))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
        }
        if ($atvidadecodido == "05" && ($subatividadecodigo >= "0501" && $subatividadecodigo <= "0504"))
        {
            $au = Input::get("areaultiu");
            $ne = Input::get("numerodeempregados");
            // tab = atv05  ; col = 1 ; lin = 1 // au = 0.1 ate 0.9 ne = de 0.1 a 99.9
            if ($au < 0.2 && $ne < 100)
            {
                $porte = "PEQUENO";
                return $porte;
            }
            // tab = atv05  ; col = 1 ; lin = 2 // au = 0.1 ate 0. 9 ne = de 100 ate 300
            if ($au < 0.2 && ($ne >= 100 && $ne <= 300))
            {
                $porte = "MEDIO";
                return $porte;
            }
            // tab = atv05  ; col = 1 ; lin = 3 // au = 0.1 ate 0. 9 ne = de 301 ate 899
            if ($au < 0.2 && ($ne > 300 && $ne < 900))
            {
                $porte = "GRANDE";
                return $porte;
            }
            // tab = atv05  ; col = 1 ; lin = 4 // au = 0.1 ate 0. 9 ne = 900++
            if ($au < 0.2 && $ne >= 900)
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv05 ; col = 2 ; lin = 1 // au = 1 ate 2 ne = 99
            if (($au >= 0.2 && $au <= 1) && $ne < 100)
            {
                $porte = "MEDIO";
                return $porte;
            }
            // tab = atv05  ; col = 2 ; lin = 2 // au = 1 ate 2 ne = 100 ate 300
            if (($au >= 0.2 && $au <= 1) && ($ne >= 100 && $ne <= 300))
            {
                $porte = "MEDIO";
                return $porte;
            }
            // tab = atv05  ; col = 2 ; lin = 3 // au = 1 ate 2 ne = 301 ate 899
            if (($au >= 0.2 && $au <= 1) && ($ne > 300 && $ne < 900))
            {
                $porte = "GRANDE";
                return $porte;
            }
            // tab = atv05  ; col = 2 ; lin = 4 // au = 1 ate 2 ne = 900++
            if (($au >= 0.2 && $au <= 1) && ($ne >= 900))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv05  ; col = 3 ; lin = 1 // au = 1.1 ate 2.99 ne = 99
            if (($au > 1 && $au < 3) && $ne < 100)
            {
                $porte = "GRANDE";
                return $porte;
            }
            // tab = atv05  ; col = 3 ; lin = 2 // au = 1.1 ate 2.99 ne = 100 ate 300
            if (($au > 1 && $au < 3) && ($ne >= 100 && $ne <= 300))
            {
                $porte = "GRANDE";
                return $porte;
            }
            // tab = atv05  ; col = 3 ; lin = 3 // au = 1.1 ate 2.99 ne = 301 ate 899
            if (($au > 1 && $au < 3) && ($ne > 300 && $ne < 900))
            {
                $porte = "GRANDE";
                return $porte;
            }
            // tab = atv05  ; col = 3 ; lin = 4  // au = 1.1 ate 2.99 ne = 900++
            if (($au > 1 && $au < 3) && ($ne >= 900))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv05  ; col =4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
            if (($au >= 3) && $ne < 100)
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv05  ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
            if (($au >= 3) && ($ne >= 100 && $ne <= 300))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv05  ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
            if (($au >= 3) && ($ne > 300 && $ne < 900))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv05  ; col = 4 ; lin = 4  // au = 3++ ne = 900++
            if (($au >= 3) && ($ne >= 900))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
        }
        if ($atvidadecodido == "06" && ($subatividadecodigo >= "0601" && $subatividadecodigo <= "0604"))
        {
            $au = Input::get("areaultiu");
            $ne = Input::get("numerodeempregados");
            // tab = atv06  ; col = 1 ; lin = 1 // au = 0.1 ate 0.9 ne = de 0.1 a 99.9
            if ($au < 1 && $ne < 100)
            {
                $porte = "PEQUENO";
                return $porte;
            }
            // tab = atv06  ; col = 1 ; lin = 2 // au = 0.1 ate 0. 9 ne = de 100 ate 200
            if ($au < 1 && ($ne >= 100 && $ne <= 200))
            {
                $porte = "MEDIO";
                return $porte;
            }
            // tab = atv06  ; col = 1 ; lin = 3 // au = 0.1 ate 0. 9 ne = de 201 ate 499
            if ($au < 1 && ($ne > 200 && $ne < 500))
            {
                $porte = "GRANDE";
                return $porte;
            }
            // tab = atv06  ; col = 1 ; lin = 4 // au = 0.1 ate 0. 9 ne = 500++
            if ($au < 1 && ($ne >= 500))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv06  ; col = 2 ; lin = 1 // au = 1 ate 2 ne = 99
            if (($au >= 1 && $au <= 2) && $ne < 100)
            {
                $porte = "MEDIO";
                return $porte;
            }
            // tab = atv06  ; col = 2 ; lin = 2 // au = 1 ate 2 ne = 100 ate 200
            if (($au >= 1 && $au <= 2) && ($ne >= 100 && $ne <= 200))
            {
                $porte = "MEDIO";
                return $porte;
            }
            // tab = atv06  ; col = 2 ; lin = 3 // au = 1 ate 2 ne = 201 ate 499
            if (($au >= 1 && $au <= 2) && ($ne > 200 && $ne < 500))
            {
                $porte = "GRANDE";
                return $porte;
            }
            // tab = atv06  ; col = 2 ; lin = 4 // au = 1 ate 2 ne = 500++
            if (($au >= 1 && $au <= 2) && ($ne >= 500))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv06  ; col = 3 ; lin = 1 // au = 2 ate 4.99 ne = 99
            if (($au > 2 && $au < 5) && $ne < 100)
            {
                $porte = "GRANDE";
                return $porte;
            }
            // tab = atv06  ; col = 3 ; lin = 2 // au = 2 ate 4.99 ne = 100 ate 300
            if (($au > 2 && $au < 5) && ($ne >= 100 && $ne <= 200))
            {
                $porte = "GRANDE";
                return $porte;
            }
            // tab = atv06  ; col = 3 ; lin = 3 // au = 2 ate 4.99 ne = 301 ate 499
            if (($au > 2 && $au < 5) && ($ne > 200 && $ne < 500))
            {
                $porte = "GRANDE";
                return $porte;
            }
            // tab = atv06  ; col = 3 ; lin = 4  // au = 2 ate 4.99 ne = 500++
            if (($au > 2 && $au < 5) && ($ne >= 500))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv06  ; col =4 ; lin = 1 // au = 3++  ne = 0.1 ate 99
            if (($au >= 5) && $ne < 100)
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv06  ; col = 4 ; lin = 2 // au = 3++ ne = 100 ate 300
            if (($au >= 5) && ($ne >= 100 && $ne <= 200))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv06  ; col = 4 ; lin = 3 // au = 3++ ne = 301 ate 899
            if (($au >= 5) && ($ne > 200 && $ne < 500))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
            // tab = atv06  ; col = 4 ; lin = 4  // au = 3++ ne = 900++
            if (($au >= 5) && ($ne >= 500))
            {
                $porte = "EXCEPCIONAL";
                return $porte;
            }
        }
    }

} 