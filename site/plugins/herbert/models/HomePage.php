<?php

class HomePage extends Page
{
  public function layout(): string {
    return $this->site()->layout();
  }
  public function dateFormat(): string {
    return $this->site()->dateFormat();
  }
  public function posts(): Kirby\Cms\Pages {
    return $this->site()->content()->featured()->toPages();
  }
}
