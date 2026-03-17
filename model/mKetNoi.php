<?php
    class mKetNoi{
        public function moKetNoi(){
            return mysqli_connect("localhost","root", "", "dbquanlysanbong2");
        }

        public function dongKetNoi($con){
            mysqli_close($con);
        }
    }
?>