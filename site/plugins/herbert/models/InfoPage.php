<?php

class InfoPage extends Page
{
  public function json(): array {

    $return = array_merge( parent::json(), array_filter([
      'description' => $this->body()->kirbytextinline()->value(),
      'collaboration' => option('repo'),
      'imprint' => $this->imprint()->value(),
      'email' => $this->contact()->value(),
    ]) );

    /* team members */
    foreach( $this->team()->toStructure() as $item ){
      $member = array_filter([
        'name' => $item->name()->html()->value(),
        'description' => $item->text()->kirbytextinline()->value(),
        'link' => $item->link()->value()
      ]);
      if( $image = $item->image()->toFile() ){
        $member['image'] = $image->json();
      }

      if( !isset($return['team']) ){
        $return['team'] = [];
      }
      $return['team'][] = $member;
    }

    /* credits */
    $return['credits'] = [
      [
        'headline' => 'Webdesign & Programming',
        'text' => 'Moritz Ebeling',
        'url' => 'https://moritzebeling.com',
      ]
    ];
    foreach( $this->credits()->toStructure() as $item ){
      $return['credits'][] = array_filter([
        'headline' => $item->job()->html()->value(),
        'text' => $item->name()->html()->value(),
        'url' => $item->link()->value(),
      ]);
    }

    return $return;
  }
}
