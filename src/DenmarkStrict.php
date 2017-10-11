<?php
/*
88""Yb 888888 88  dP 88""Yb    db    888888 888888    db
88__dP 88__   88odP  88__dP   dPYb   88__     88     dPYb
88""Yb 88""   88"Yb  88"Yb   dP__Yb  88""     88    dP__Yb
88oodP 888888 88  Yb 88  Yb dP""""Yb 88       88   dP""""Yb
*/

namespace Bekrafta;

class DenmarkStrict extends Denmark {
    protected function validateChecksum(): bool {
        $group = [4, 3, 2, 7, 6, 5, 4, 3, 2, 1];

        if (!$this->validateBitCheckSum($group)) {
            return false;
        }

        return true;
    }
}
