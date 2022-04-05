<?php
/**
 * @author Virgile & Walid
 * @version 1.0
 */

/**
 * Class Grid
 */
class Grid {
    private $grid = array();

    /**
     * Grid constructor.
     */
    public function __construct() {
        for ($i=0; $i<4; $i++) $this->grid[$i] = array(0, 0, 0, 0);
    }

    /**
     * @param int $x
     * @param int $y
     * @return mixed
     * function which return the value in the grid at the position (x,y).
     */
    public function get(int $x, int $y) {
        return $this->grid[$y][$x];
    }

    /**
     * @param int $x
     * @param int $y
     * @param int $val
     * function which set the value "val" in the grid at the position (x,y).
     */
    public function set(int $x, int $y, int $val) {
        $this->grid[$y][$x] = $val;
    }

    /**
     * function which call two times getAlea() to get two random values in the grid.
     */
    public function startGame() {
        $this->getAlea();
        $this->getAlea();
    }

    /**
     * function which place randomly in the grid a value between 2 and 4.
     */
    private function getAlea() {
        $i = rand(0,3);
        $j = rand(0,3);
        if ($this->get($i, $j) == 0) $this->set($i, $j, $this->getTheAleaInt());
        else $this->getAlea();
    }

    /**
     * @return int
     * function which return an int randomly between 2 and 4.
     */
    private function getTheAleaInt() {
        $i = rand(1,2);
        if ($i == 1) return 2;
        else return 4;
    }

    /**
     * @return bool
     * function which check if there is a movement possible
     */
    public function hasEqualNext() {
        for ($y=1; $y<3; $y++) {
            for ($x=1; $x<3; $x++) {
                $caseCurrent = $this->get($x, $y);
                if ($this->get($x+1, $y) == $caseCurrent or
                $this->get($x-1, $y) == $caseCurrent or
                $this->get($x, $y+1) == $caseCurrent or
                $this->get($x, $y-1) == $caseCurrent)
                    return true;
            }
        }
        return false;
    }

    /**
     * function which make all the case to move to the down.
     */
    public function moveDown() : void {
        for($y = 0; $y < 4; $y++) {
            $x = 3;
            while($x >= 1) {
                $caseI = $this->get($x, $y);
                $caseJ = $this->get($x - 1, $y);
                if($caseI == 0 && $caseJ != 0) {
                    $this->set($x, $y, $caseJ);
                    $this->set($x - 1, $y, 0);
                    $x = 3;
                    continue;
                }
                $x--;
            }
        }
        for($y = 0; $y < 4; $y++) {
            $x = 3;
            while($x >= 1) {
                $caseI = $this->get($x, $y);
                $caseJ = $this->get($x - 1, $y);
                if($caseI == $caseJ) {
                    $this->set($x, $y, $caseJ * 2);
                    $_SESSION['score'] += $caseJ*2;
                    $this->set($x - 1, $y, 0);
                }
                $x--;
            }
        }
        for($y = 0; $y < 4; $y++) {
            $x = 3;
            while($x >= 1) {
                $caseI = $this->get($x, $y);
                $caseJ = $this->get($x - 1, $y);
                if($caseI == 0 && $caseJ != 0) {
                    $this->set($x, $y, $caseJ);
                    $this->set($x - 1, $y, 0);
                    $x = 3;
                    continue;
                }
                $x--;
            }
        }
        $this->getAlea();
    }

    /**
     * function which make all the case to move to the top.
     */
    public function moveUp() : void {
        for($y = 0; $y < 4; $y++) {
            $x = 0;
            while($x <= 2) {
                $caseI = $this->get($x, $y);
                $caseJ = $this->get($x + 1, $y);
                if($caseI == 0 && $caseJ != 0) {
                    $this->set($x, $y, $caseJ);
                    $this->set($x + 1, $y, 0);
                    $x = 0;
                    continue;
                }
                $x++;
            }
        }
        for($y = 0; $y < 4; $y++) {
            $x = 0;
            while($x <= 2) {
                $caseI = $this->get($x, $y);
                $caseJ = $this->get($x + 1, $y);
                if($caseI == $caseJ) {
                    $this->set($x, $y, $caseJ * 2);
                    $_SESSION['score'] += $caseJ*2;
                    $this->set($x + 1, $y, 0);
                }
                $x++;
            }
        }
        for($y = 0; $y < 4; $y++) {
            $x = 0;
            while($x <= 2) {
                $caseI = $this->get($x, $y);
                $caseJ = $this->get($x + 1, $y);
                if($caseI == 0 && $caseJ != 0) {
                    $this->set($x, $y, $caseJ);
                    $this->set($x + 1, $y, 0);
                    $x = 0;
                    continue;
                }
                $x++;
            }
        }
        $this->getAlea();
    }

    /**
     * function which make all the case to move to the right.
     */
    public function moveRight() : void {
        for($x = 0; $x < 4; $x++) {
            $y = 3;
            while($y >= 1) {
                $caseI = $this->get($x, $y);
                $caseJ = $this->get($x, $y - 1);
                if($caseI == 0 && $caseJ != 0) {
                    $this->set($x, $y, $caseJ);
                    $this->set($x, $y - 1, 0);
                    $y = 3;
                    continue;
                }
                $y--;
            }
        }
        for($x = 0; $x < 4; $x++) {
            $y = 3;
            while($y >= 1) {
                $caseI = $this->get($x, $y);
                $caseJ = $this->get($x, $y - 1);
                if($caseI == $caseJ) {
                    $this->set($x, $y, $caseJ * 2);
                    $_SESSION['score'] += $caseJ*2;
                    $this->set($x, $y - 1, 0);
                }
                $y--;
            }
        }
        for($x = 0; $x < 4; $x++) {
            $y = 3;
            while($y >= 1) {
                $caseI = $this->get($x, $y);
                $caseJ = $this->get($x, $y - 1);
                if($caseI == 0 && $caseJ != 0) {
                    $this->set($x, $y, $caseJ);
                    $this->set($x, $y - 1, 0);
                    $y = 3;
                    continue;
                }
                $y--;
            }
        }
        $this->getAlea();
    }

    /**
     * function which make all the case to move to the left.
     */
    public function moveLeft() : void {
        for($x = 0; $x < 4; $x++) {
            $y = 0;
            while($y <= 2) {
                $caseI = $this->get($x, $y);
                $caseJ = $this->get($x, $y + 1);
                if($caseI == 0 && $caseJ != 0) {
                    $this->set($x, $y, $caseJ);
                    $this->set($x, $y + 1, 0);
                    $y = 0;
                    continue;
                }
                $y++;
            }
        }
        for($x = 0; $x < 4; $x++) {
            $y = 0;
            while($y <= 2) {
                $caseI = $this->get($x, $y);
                $caseJ = $this->get($x, $y + 1);
                if($caseI == $caseJ) {
                    $this->set($x, $y, $caseJ * 2);
                    $_SESSION['score'] += $caseJ*2;
                    $this->set($x, $y + 1, 0);
                }
                $y++;
            }
        }
        for($x = 0; $x < 4; $x++) {
            $y = 0;
            while($y <= 2) {
                $caseI = $this->get($x, $y);
                $caseJ = $this->get($x, $y + 1);
                if($caseI == 0 && $caseJ != 0) {
                    $this->set($x, $y, $caseJ);
                    $this->set($x, $y + 1, 0);
                    $y = 0;
                    continue;
                }
                $y++;
            }
        }
        $this->getAlea();
    }
}