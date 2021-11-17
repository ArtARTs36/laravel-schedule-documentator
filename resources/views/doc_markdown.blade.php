## App Console Schedule

|  Command Description  | Command Signature  | Frequency |
| ------------ | ------------ | ------------ |
@foreach($events as $event)
| {{ $event->command->description }}  | {{ $event->command->signature }}  | {{ $event->frequency->toClearName() }} ({{ ($event->frequency->value()) }})  |
@endforeach
