import {useState} from "react";

export default (props) => {
    const [date] = useState(new Date());

    return(
        <a href={props.url} target={'_blank'} className={'main-title-url'}>
            <h1 className={'primary-text-color main-title'}>{date.getDate()} {date.toLocaleString('en-us', {month: 'long'})} {date.getFullYear()}</h1>
        </a>
    );
}
