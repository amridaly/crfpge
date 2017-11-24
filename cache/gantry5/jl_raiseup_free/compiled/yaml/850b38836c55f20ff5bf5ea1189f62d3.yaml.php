<?php
return [
    '@class' => 'Gantry\\Component\\File\\CompiledYamlFile',
    'filename' => 'C:\\wamp64\\www\\CRFPGE/templates/jl_raiseup_free/config/default/particles/joomlacontent.yaml',
    'modified' => 1511198868,
    'data' => [
        'enabled' => '1',
        'slide' => 'none',
        'style' => '0',
        'columns' => '4',
        'autoplay' => '1',
        'pause' => '1',
        'interval' => '7000',
        'slidenav' => '1',
        'dotnav' => '0',
        'gutter' => 'uk-grid-medium',
        'slider' => [
            'center' => '0',
            'infinite' => '1'
        ],
        'slideset' => [
            'animation' => 'fade',
            'duration' => '200'
        ],
        'article' => [
            'display' => [
                'image' => [
                    'enabled' => 'intro'
                ],
                'text' => [
                    'type' => 'intro',
                    'limit' => '',
                    'formatting' => 'text'
                ],
                'title' => [
                    'enabled' => 'show',
                    'limit' => ''
                ],
                'date' => [
                    'enabled' => 'published',
                    'format' => 'l, F d, Y'
                ],
                'read_more' => [
                    'enabled' => 'show',
                    'label' => '',
                    'css' => ''
                ],
                'author' => [
                    'enabled' => 'show'
                ],
                'category' => [
                    'enabled' => 'link'
                ],
                'hits' => [
                    'enabled' => 'show'
                ]
            ]
        ],
        'template' => [
            'enabled' => '0',
            'content' => '<div class="jl-content-item">
	<div class="jl-content-item-container uk-grid uk-grid-margin">
	
		<div class="jl-content-item-image uk-width-1-1">
             <a href="%articleLink%">
                 %articleImage%
             </a>
         </div>
		 <div class="jl-content-item-title uk-width-1-1">
              <h3 class="jl-content-item-title">
				<a href="%articleRoute%">
                  %articleTitle%
				</a>
              </h3>
         </div>
		 
		 <div class="jl-content-item-details">
			<span class="jl-content-item-date">
                <i class="fa fa-clock-o" aria-hidden="true"></i>
                %articleDate%
            </span>
			<span class="jl-content-item-author">
                <i class="fa fa-user" aria-hidden="true"></i>
                %articleAuthor%
            </span>
			<span class="jl-content-item-category">
				<a href="%articleCategoryLink%">
                   <i class="fa fa-folder-open" aria-hidden="true"></i>
				   %articleCategoryTitle%
                </a>
			</span>
			<span class="jl-content-item-hits">
				<i class="fa fa-eye" aria-hidden="true"></i>
				%articleHits%
			</span>
		 </div>
		 <div class="jl-content-item-text uk-width-1-1">
            %articleText%
         </div>
		 <div class="jl-content-item-read-more">
            <a href="{{ article.route }}">
              %articleReadmore%
            </a>
         </div>
	</div>
</div>'
        ],
        'class' => ''
    ]
];
