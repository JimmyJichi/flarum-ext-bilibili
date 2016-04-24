<?php namespace JJaicmkmy\Bilibili;

use Flarum\Event\ConfigureFormatter;
use Illuminate\Events\Dispatcher;

function subscribe(Dispatcher $events)
{
	$events->listen(
		ConfigureFormatter::class,
		function (ConfigureFormatter $event)
		{
			$event->configurator->MediaEmbed->add(
'bilibili',
[
    'host'    => 'www.bilibili.com',
    'extract' => "!www.bilibili.com/video/av(?'id'[0-9]+)/!",
    'flash'  => [
        'width'  => 640,
        'height' => 360,
        'src'    => 'https://static-s.bilibili.com/miniloader.swf?aid={@id}'
    ]
]
);

		}
	);
};

return __NAMESPACE__ . '\\subscribe';
