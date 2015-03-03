<header class="navbar navbar-inverse ">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" target="_blank" href="<?php echo $this->Html->url('/'); ?>">Ouvrir le site</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <?php
                $menu = Configure::read('Config.backendMenu');
                if (!empty($menu)) {
                    foreach ($menu as $linkName => $link) {
                        //echo $this->Html->tag('li', $this->Html->link( $linkName, $link ) );
                        if (is_array($link)) {
                            if (array_key_exists('dropdown', $link)) {
                                $d = '';
                                foreach ($link['dropdown'] as $dropName => $dropLink) {
                                    $d .= $this->Html->tag('li', $this->Html->link($dropName, $dropLink));
                                }
                                $html = '<a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $linkName . ' <b class="caret"></b></a>';
                                $html .= $this->Html->tag('ul', $d, array('class' => 'dropdown-menu'));
                                echo $this->Html->tag('li', $html, array('class' => 'dropdown'));
                            } else {
                                echo $this->Html->tag('li', $this->Html->link($linkName, $link));
                            }
                        } else {
                            echo $this->Html->tag('li', $this->Html->link($linkName, $link));
                        }
                    }
                }
                ?>
            </ul>
        </div><!--/.navbar-collapse -->
    </div>
</header>