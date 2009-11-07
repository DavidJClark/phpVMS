<?php
/**
 * phpVMS - Virtual Airline Administration Software
 * Copyright (c) 2008 Nabeel Shahzad
 * For more information, visit www.phpvms.net
 *	Forums: http://www.phpvms.net/forum
 *	Documentation: http://www.phpvms.net/docs
 *
 * phpVMS is licenced under the following license:
 *   Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
 *   View license.txt in the root, or visit http://creativecommons.org/licenses/by-nc-sa/3.0/
 *
 * @author Nabeel Shahzad
 * @copyright Copyright (c) 2008, Nabeel Shahzad
 * @link http://www.phpvms.net
 * @license http://creativecommons.org/licenses/by-nc-sa/3.0/
 */

class Finances extends CodonModule
{
	
	public function index()
	{
		$this->viewreport();
	}
	
	public function viewcurrent()
	{
		$this->viewreport();
	}
	
	public function viewreport()
	{
		$type = $this->get->type;
					
		/**
		 * Check the first letter in the type
		 * m#### - month
		 * y#### - year
		 * 
		 * No type indicates to view the 'overall'
		 */
		if($type[0] == 'm')
		{
			$type = str_replace('m', '', $type);
			$period = date('F Y', $type);
			
			$data = FinanceData::GetMonthBalanceData($period);
			
			$this->set('title', 'Balance Sheet for '.$period);
			$this->set('allfinances', $data);
			
			$this->render('finance_balancesheet.tpl');
		}
		elseif($type[0] == 'y')
		{
			$type = str_replace('y', '', $type);

			$data = FinanceData::GetYearBalanceData($type);
			
			$this->set('title', 'Balance Sheet for Year '.date('Y', $type));
			$this->set('allfinances', $data);
			$this->set('year', date('Y', $type));
			
			$this->render('finance_summarysheet.tpl');
		}
		else
		{
			// This should be the last 3 months overview
			
			$data = FinanceData::GetRangeBalanceData('-3 months', 'Today');
			
			$this->set('title', 'Balance Sheet for Last 3 Months');
			$this->set('allfinances', $data);					
			$this->render('finance_summarysheet.tpl');
		}		
	}
	
	public function viewexpenses()
	{
		$this->set('allexpenses', FinanceData::GetAllExpenses());
		$this->render('finance_expenselist.tpl');
	}
}