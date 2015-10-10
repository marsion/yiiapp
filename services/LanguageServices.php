<?php

namespace app\services;

use app\dao\LanguageDAO;
use app\models\LanguageModel;

class LanguageServices
{

    protected function dao()
    {
        return new LanguageDAO();
    }

    public function getFilterOptionsLanguages($lang)
    {
        if ($data = self::dao()->findFilterOptionsLanguages($lang)) {
            foreach ($data as $row) {
                $lang = new LanguageModel();
                $lang->id = $row['lang_id'];
                $lang->name = $row['name'];

                $langs[] = $lang;
            }

            return $langs;
        } else {
            return array();
        }
    }

    public function getFilterOptionsLanguagesOrig($langor)
    {
        if ($data = self::dao()->findFilterOptionsLanguages($langor)) {
            foreach ($data as $row) {
                $lang = new LanguageModel();
                $lang->id = $row['lang_id'];
                $lang->name = $row['name'];

                $langs[] = $lang;
            }

            return $langs;
        } else {
            return array();
        }
    }

    public function getLanguageById($id)
    {
        if ($row = self::dao()->findLanguageById($id)) {
            $lang = new LanguageModel();
            $lang->id = $row['lang_id'];
            $lang->name = $row['name'];

            return $lang;
        } else {
            return array();
        }
    }
}

?>