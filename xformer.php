<?php 

class xFormer {
  
	/**
	* xFormer by Sergey ~Vinyl~ Antonov / vinyl@arbx.ru
	* man http://forum.php.su/topic.php?forum=35&topic=821
 	*/
	
	private $tabs = '';
	private $spaces = '';
	private $miltipart = false;
	private $xhtmlSlash = '';
	private $lock = false;
	private $pwdSwitch = false;
	private $btnSwitch = false;
	private $checkedTag = ' checked';
	private $readonlyTag = ' readonly';
	private $disabledTag = ' disabled';
	private $multipleTag = ' multiple';
	private $selectedTag = ' selected';
	
	public function setTabs($num){
		
		$num = (int)$num;
		for($i=0;$i<$num;$i++)
		{
			$this->tabs .= "\t";
		}
	}
		
	public function setSpaces($num){
		
		$num = (int)$num;
		for($i=0;$i<$num;$i++)
		{
			$this->spaces .= ' ';
		}
	}
	
	public function setXhtml(){
		
		$this->xhtmlSlash = ' /';
		$this->checkedTag = ' checked="checked"';
		$this->readonlyTag = ' readonly="readonly"';
		$this->disabledTag = ' disabled="disabled"';
		$this->multipleTag = ' multiple="multiple"';
		$this->selectedTag = ' selected="selected"';
		
	}
	
	public function formStart($action, $method = 'p', $id = false, $enctype = 0, $name = '', $target = '', $accept_charset = 0, $autocomplete = false, $string = false){
		
		if($this->lock === false)
		{
		
			$action = (string)$action;
			!empty($action) ? $action = ' action="'.$action.'"' : 1;		
			
			
			$method = (string)$method;
			(empty($method) || strtolower($method) == 'g' || strtolower($method) == 'get') ? $method = ' method="GET"' : $method = ' method="POST"';
			
			if($id === false)
			{
				$id = '';
			}
			
			else
			{
				$id = (string)$id;
				$id = ' id="'.$id.'"';
			}
			
			$enctype = (int)$enctype;
			switch($enctype)
			{
				case 1: $enctype = ' enctype="multipart/form-data"'; $this->miltipart = true; break;
				case 2: $enctype = ' enctype="text/plain"'; break;
				default: $enctype = ' enctype="application/x-www-form-urlencoded"'; break;
			}
			
			
			$name = (string)$name;
			!empty($name) ? $name = ' name="'.$name.'"' : $name = '';
			
			
			$target = strtolower((string)$target);
			switch($target)
			{
				case 'b': $target = ' target="_blank"'; break;
				case 'p': $target = ' target="_parent"'; break;
				case 't': $target = ' target="_top"'; break;
				default: $target = ' target="_self"'; break;
			}
			
			
			$accept_charset = (int)$accept_charset;
			switch($accept_charset)
			{
				case 1: $accept_charset = ' accept-charset="utf-8"'; break;
				case 2: $accept_charset = ' accept-charset="windows-1251"'; break;
				default: $accept_charset = ''; break;
			}
			
			
			if($autocomplete === false)
			{
				$autocomplete = '';
			}
			
			else
			{
				$autocomplete = (int)$autocomplete;
				($autocomplete == 0) ? $autocomplete = ' autocomplete="off"' : $autocomplete = ' autocomplete="on"';
			}
			
			($string === false) ? $string = '' : $string = ' '.(string)$string;
			
			
			$str = PHP_EOL.$this->tabs.$this->spaces.'<form '.$action.$method.$enctype.$name.$target.$accept_charset.$autocomplete.$string.'>';
			
			$this->lock = true;
			
			return $str;
		}
		
	}
	
	
	public function formEnd(){
		
		if($this->lock == true)
		{
			$this->lock = false;
			return PHP_EOL.$this->tabs.$this->spaces.'</form>';
		}
	}
	
	
	public function getText($name, $id = false, $value = false, $disabled = false, $readonly = false, $maxlength = false, $string = false){
		
		$name = (string)$name;
		$name = ' name="'.$name.'"';
		
		$id = (string)$id;
		empty($id) ? $id = '' : $id = ' id="'.$id.'"';
		
		
		$value = (string)$value;
		empty($value) ? $value = '' : $value = ' value="'.$value.'"';
		
		
		if($disabled === false)
		{
			$disabled = '';
		}
		
		else
		{
			$disabled = $this->disabledTag;
		}  
		
		
		if($readonly === false)
		{
			$readonly = '';
		}
		
		else
		{
			$readonly = $this->readonlyTag;
		}  

		
		$maxlength = (int)$maxlength;
		empty($maxlength) ? $maxlength = '' : $maxlength = ' maxlength="'.$maxlength.'"';
		
		($string === false) ? $string = '' : $string = ' '.(string)$string;
		
		($this->pwdSwitch === true) ? $type = 'password' : $type = 'text';
		
		$ret = PHP_EOL.$this->tabs.$this->spaces.'<input type="'.$type.'"'.$name.$id.$value.$disabled.$readonly.$maxlength.$string.$this->xhtmlSlash.'>';
		
		return $ret;
	}
	
	
	public function getHidden($name, $value, $id = false, $disabled = false, $string = false){
		
		
		$name = (string)$name;
		$name = ' name="'.$name.'"';
		
		$id = (string)$id;
		empty($id) ? $id = '' : $id = ' id="'.$id.'"';
		
		
		$value = (string)$value;
		empty($value) ? $value = '' : $value = ' value="'.$value.'"';
		
		
		if($disabled === false)
		{
			$disabled = '';
		}
		
		else
		{
			$disabled = $this->disabledTag;
		}  
		
		empty($maxlength) ? $maxlength = '' : $maxlength = ' maxlength="'.$maxlength.'"';
		
		($string === false) ? $string = '' : $string = ' '.(string)$string;
		
		$ret = PHP_EOL.$this->tabs.$this->spaces.'<input type="hidden"'.$name.$id.$value.$disabled.$string.$this->xhtmlSlash.'>';
		
		return $ret;
	}
	

	public function getTextarea($name, $id = false, $text = false, $disabled = false, $readonly = false, $string = false){
		
		$name = (string)$name;
		$name = ' name="'.$name.'"';
		
		$id = (string)$id;
		empty($id) ? $id = '' : $id = ' id="'.$id.'"';
		
		$text = (string)$text;
		
		if($disabled === false)
		{
			$disabled = '';
		}
		
		else
		{
			$disabled = $this->disabledTag;
		}  
		
		
		if($readonly === false)
		{
			$readonly = '';
		}
		
		else
		{
			$readonly = $this->readonlyTag;
		}  
		
		($string === false) ? $string = '' : $string = ' '.(string)$string;
		
		$ret = PHP_EOL.$this->tabs.$this->spaces.'<textarea'.$name.$id.$disabled.$readonly.$string.'>'.$text.'</textarea>';
		
		return $ret;
		
	}


	public function getPassword($name, $id = false, $value = false, $disabled = false, $readonly = false, $maxlength = false, $string = false){
		
		$this->pwdSwitch = true;
		$ret = $this->getText($name, $id, $value, $disabled, $readonly, $maxlength, $string);
		$this->pwdSwitch = false;
		
		return $ret;
		
	}
	
	
	public function getCheckbox($name, $value = false, $checked = false, $id = false, $label = false, $disabled = false, $string = false){
		
		$name = (string)$name;
		$name = ' name="'.$name.'"';
		
		$id = (string)$id;
		empty($id) ? $id = '' : $id = ' id="'.$id.'"';	
			
		$value = (string)$value;
		empty($value) ? $value = '' : $value = ' value="'.$value.'"';
		
		if(!empty($label))
		{
			$labelOpen = '<label>';
			$labelClose = $label.'</label>';
		}
		
		else
		{
			$labelOpen = '';
			$labelClose = '';
		}
		
		if($disabled === false)
		{
			$disabled = '';
		}
		
		else
		{
			$disabled = $this->disabledTag;
		} 
		
		if($checked === false)
		{
			$checked = '';
		}
		
		else
		{
			$checked = $this->checkedTag;
		} 
		
		($string === false) ? $string = '' : $string = ' '.(string)$string;
		
		$ret = PHP_EOL.$this->tabs.$this->spaces.$labelOpen.'<input type="checkbox"'.$name.$id.$value.$disabled.$checked.$string.$this->xhtmlSlash.'>'.$labelClose;
		return $ret;
		 
	}


	public function getRadio($name, $itemsArray, $id = false, $string = false){
		
		$ret = '';
		$checkedable = true;
		$name = (string)$name;
		$name = ' name="'.$name.'"';
		
		$id = (string)$id;
		empty($id) ? $id = '' : $id = ' id="'.$id.'"';
		
		($string === false) ? $string = '' : $string = ' '.(string)$string;
		
		if(is_array($itemsArray))
		{
			foreach($itemsArray as $key=>$params)
			{
				if(is_array($params))
				{
					isset($params['name']) ? $iName = (string)$params['name'] : $iName = $key;
					if(isset($params['checked']) && $params['checked'] == 1 && $checkedable === true) 
					{
						$iChecked = $this->checkedTag;
						$checkedable = false;
					}
					else
					{
						$iChecked = '';	
					}
					
					(isset($params['disabled']) && $params['disabled'] == 1) ? $iDdisabled = $this->disabledTag : $iDdisabled = '';
					
					$ret .= PHP_EOL.$this->tabs.$this->spaces.'<label><input type="radio"'.$name.' value="'.$key.'"'.$id.$iChecked.$iDdisabled.$string.$this->xhtmlSlash.'>'.$iName.'</label>';
				}
			}
		}
		
		return $ret;
		
	}
	

	public function getSelect($name, $itemsArray, $id = false, $multiple = false, $disabled = false, $string = false){
		
		$name = (string)$name;
		$name = ' name="'.$name.'"';
		
		$id = (string)$id;
		empty($id) ? $id = '' : $id = ' id="'.$id.'"';
		
		($multiple !== false) ? $multiple = $this->multipleTag : $multiple = '';	
		($disabled !== false) ? $disabled = $this->disabledTag : $disabled = '';	
		
		if(is_array($itemsArray))
		{
			$items = '';
			
			foreach($itemsArray as $key=>$params)
			{
				if(is_array($params))
				{
					isset($params['name']) ? $iName = (string)$params['name'] : $iName = $key;
					(isset($params['selected']) && $params['selected'] == 1) ? $iSelected = $this->selectedTag : $iSelected = '';
					(isset($params['disabled']) && $params['disabled'] == 1) ? $iDdisabled = $this->disabledTag : $iDdisabled = '';

				
					$items .= PHP_EOL."\t".$this->tabs.$this->spaces.'<option value="'.$key.'"'.$iSelected.$iDdisabled.'>'.$iName.'</option>';	
				}
			}
			
		}
		
		($string === false) ? $string = '' : $string = ' '.(string)$string;
		
		$ret = PHP_EOL.$this->tabs.$this->spaces.'<select'.$name.$id.$multiple.$disabled.$string.'>'.$items;
		$ret .= PHP_EOL.$this->tabs.$this->spaces.'</select>';
		
		return $ret;
		
	}


	public function getButton($value, $id = false, $name = false, $disabled = false, $string = false){
		
		if($disabled === false)
		{
			$disabled = '';
		}
		
		else
		{
			$disabled = $this->disabledTag;
		} 
		
		($string === false) ? $string = '' : $string = ' '.(string)$string;
		($name === false) ? $name = '' : $name = ' '.(string)$name;
		
		$value = (string)$value;
		$value = ' value="'.$value.'"';
		
		$id = (string)$id;
		empty($id) ? $id = '' : $id = ' id="'.$id.'"';
		
		switch($this->btnSwitch)
		{
			case 1: $type = 'reset'; break;
			case 2: $type = 'submit'; break;
			case 3: $type = 'file'; $value = ''; break;
			default: $type = 'button'; break;
		}
		
		$ret = PHP_EOL.$this->tabs.$this->spaces.'<input type="'.$type.'"'.$value.$id.$name.$disabled.$string.$this->xhtmlSlash.'>';
		return $ret;
		
	}


	public function getReset($value, $id = false, $name = false, $disabled = false, $string = false){
		
		$this->btnSwitch = 1;
		$ret = $this->getButton($value, $id, $name, $disabled, $string);
		$this->btnSwitch = false;
		return $ret;
	}


	public function getSubmit($value, $id = false, $name = false, $disabled = false, $string = false){
		
		$this->btnSwitch = 2;
		$ret = $this->getButton($value, $id, $name, $disabled, $string);
		$this->btnSwitch = false;
		return $ret;
	}


	public function getFile($name, $id = false, $disabled = false, $string = false){
		
		if($this->miltipart === true)
		{
			$this->btnSwitch = 3;
			$ret = $this->getButton('', $id, $name, $disabled, $string);
			$this->btnSwitch = false;
			return $ret;
		}
	}
		
}
