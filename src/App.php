<?php
namespace Kirill\VK;

class App {
    const TYPE_GAME = 'game';
    const TYPE_APP = 'app';
    
    const SECTION_LOGIC = 'Logic';
    const SECTION_OTHER = 'Other';
    const SECTION_MULTIMEDIA = 'Multimedia';
    const SECTION_ARCADE = 'Arcade';
    const SECTION_EDUCATIONAL = 'Educational';
    const SECTION_DRAWING = 'Drawing';
    const SECTION_COMMUNICATION = 'Communication';
    const SECTION_BOARD_GAMES = 'Board Games';
    const SECTION_ECONOMIC = 'Economic';
    const SECTION_SIMULATORS = 'Simulators';
    const SECTION_NEWS = 'News';
    const SECTION_ADVENTURE = 'Adventure';
    const SECTION_E_COMMERCE = 'E-Commerce';
    const SECTION_STRATEGY = 'Strategy';
    const SECTION_3D_SHOOTERS = '3D shooters';
    const SECTION_RACING = 'Racing';
    const SECTION_RPG = 'RPG';
        
    public static function getTypes(){
        return self::getConstants('TYPE');
    }
    
    public static function getSections(){
        return self::getConstants('SECTION');
    }
    
    public static function getConstantsForType($type){
        $ret = [self::SECTION_OTHER];
        
        if($type === self::TYPE_APP){
            $ret = array_merge($ret, [
                self::SECTION_MULTIMEDIA,
                self::SECTION_EDUCATIONAL,
                self::SECTION_DRAWING,
                self::SECTION_COMMUNICATION,
                self::SECTION_NEWS,
                self::SECTION_E_COMMERCE
            ]);
        } else if($type === self::TYPE_GAME){
            $ret = array_merge($ret, [
                self::SECTION_LOGIC,
                self::SECTION_ARCADE,
                self::SECTION_BOARD_GAMES,
                self::SECTION_ECONOMIC,
                self::SECTION_SIMULATORS,
                self::SECTION_ADVENTURE,
                self::SECTION_STRATEGY,
                self::SECTION_3D_SHOOTERS,
                self::SECTION_RACING,
                self::SECTION_RPG
            ]);
        } else {
            throw new \InvalidArgumentException("Unsupported type '$type'");
        }
        
        return $ret;
    }
    
    private static function getConstants($prefix){
        $ret = [];
        foreach((new \ReflectionClass(__CLASS__))->getConstants() as $const => $v){
            if(strpos($const, $prefix) === 0){
                $ret[] = $v;
            }
        }
        
        return $ret;
        
    }
}
