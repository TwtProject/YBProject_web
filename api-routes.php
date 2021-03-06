<?php
    require_once 'conn/config.php';
    class API {
    var $db;
        function selectData() {
        global $db;
        $this->db = $db;
            $products = array();
            $data = $db->prepare('SELECT * FROM tb_produk ORDER BY id LIMIT 6');
            $data->execute();
            while($OutputData = $data->fetch(PDO::FETCH_ASSOC)){
                $products[] = [
                    'id' => $OutputData['id'],
                    'nama_produk' => $OutputData['nama_produk'],
                    'link' => $OutputData['link'],
                    'gambar' => $OutputData['gambar']
                ];
            }
            $setting = array();
            $data2 = $db->prepare('SELECT * FROM tb_setting ORDER BY id LIMIT 1');
            $data2->execute();
            while ($result = $data2->fetch(PDO::FETCH_ASSOC)) {
                $setting[] = [
                    'nomor' => $result['whatsapp'],
                    'isi' => $result['isi_pesan'],
                    'thumb' => $result['gambar']
                ];
            }
            $banner = array();
            $data3 = $db->prepare('SELECT * FROM tb_banner ORDER BY id LIMIT 6');
            $data3->execute();
            while ($res = $data3->fetch(PDO::FETCH_ASSOC)) {
                $banner[] = [
                    'id' => $res['id'],
                    'nama_produk' => $res['nama_produk'],
                    'link' => $res['link'],
                    'gambar' => $res['gambar']
                ];
            }
            $status = array(
                'status' => "true",
                'message' => "Data fetch successfully",
                'data' => $products,
                'banner' => $banner,
                'setting' => $setting
            );
            return json_encode($status);
        }
        
    }
    
    $API = new API;
    header('Content-Type: application/json');
    echo $API->selectData();

    
?>