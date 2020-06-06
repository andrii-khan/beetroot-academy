<?php
declare(strict_types=1);
/*
 * Class GenreService
 */
class GenreService
{
    public function getGenreStats(){
        $sql = 'SELECT g.name, count(b.id) total from book b join genre g ON g.id = b.genre_id group by g.name order by total';
        $pdo = getPDO();
        $stmt = $pdo->query($sql);
//        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->showAsPercents($stats);
    }

    private function showAsPercents($stats) {
        $totalBook = array_sum(array_column($stats,'total'));
        foreach ($stats as &$stat) {
            $stat['percent'] = round($stat['total'] / $totalBook * 100, 1);
        }
        return $stats;
    }
}