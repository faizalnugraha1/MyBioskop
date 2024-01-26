<?php
namespace Application\Controller;

use Zend\Db\TableGateway\TableGateway;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class PembayaranController extends AbstractActionController
{
    private $filmTable;

    public function __construct(TableGateway $filmTable)
    {
        $this->filmTable = $filmTable;
    }

    public function updateStatusAction()
    {
        $filmId = $this->params()->fromQuery('id_film');
        $status = $this->params()->fromQuery('deskripsi');

        // Update status pembayaran ke database
        $this->filmTable->update(['deskripsi' => $status], ['id' => $filmId]);

        // Respon JSON sukses
        return new JsonModel(['Telah Dibayar' => true]);
    }
}
?>