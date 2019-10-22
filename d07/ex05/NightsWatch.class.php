<?php

	class NightsWatch implements IFighter {
		private $_fight = [];

		public function recruit($thing) {
			if ($thing instanceof IFighter)
				array_push($this->_fight, $thing);
		}

		public function fight () {
			foreach ($this->_fight as $fighter)
				$fighter->fight();
		}
	}