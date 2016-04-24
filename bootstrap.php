<?php namespace JJaicmkmy\Flarum\MediaEmbed;

use Flarum\Events\FormatterConfigurator;
use Flarum\Support\Extension as BaseExtension;
use Illuminate\Events\Dispatcher;
use s9e\TextFormatter\Configurator\Bundles\MediaPack;

class Extension extends BaseExtension
{
    public function listen(Dispatcher $events)
    {
        $events->subscribe(__NAMESPACE__ . '\\Listener');
    }
}

class Listener
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen('Flarum\\Events\\FormatterConfigurator', [$this, 'addMediaSites']);
    }

    public function addMediaSites(FormatterConfigurator $event)
    {
        $event->configurator->templateChecker->remove('DisallowUnsafeDynamicCSS');
        $event->configurator->MediaEmbed->enableResponsiveEmbeds();


$event->configurator->MediaEmbed->add(
'bilibili',
[
    'host'    => 'www.bilibili.com',
    'extract' => "!www.bilibili.com/video/av(?'id'[0-9]+)/!",
    'iframe'  => [
        'width'  => 720,
        'height' => 405,
        'src'    => 'https://bilidown.tlo.xyz/embed.php/{@id}.mp4'
    ]
]
);

        (new MediaPack)->configure($event->configurator);
    }
}

return __NAMESPACE__ . '\\Extension';
