import Sprite from '../assets/nucleo-sprite.svg';

export default function SvgIcon({icon, className, size = 24}) {
    return (
        <svg className={`nui stroke-2 ${className}`} width={size} height={size}>
            <use xlinkHref={`${Sprite}#nui-${icon}`}/>
        </svg>
    )
}