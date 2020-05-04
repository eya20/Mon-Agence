<?php 

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class PropertySearch {

    /**
     * @var int|null
     */
    private $maxprice;
    

    /**
     * @var int|null
     *@Assert\Range(min = 10, max = 400)
     */

    private $minSurface;

    /**
     * @return int|null
     */
    public function getMinSurface(): ?int 
    {
		return $this->minSurface;
	}

    
    public function setMinSurface(int $minSurface): self
    {
        $this->minSurface = $minSurface;
        return $this;
    }
    
    /**
     * @return int|null
     */
    public function getMaxprice(): ?int  
    {
		return $this->maxprice;
	}

    /**
     * @param int|null  $maxprice
     * @return PropertySearch
     */
    public function setMaxprice(int $maxprice): self 
    {
        $this->maxprice = $maxprice;
        return $this;
	}

    
}

