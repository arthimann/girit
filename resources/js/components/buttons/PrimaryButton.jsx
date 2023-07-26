import {Button} from "@mui/material";

export default props => {
    const theme = {
        color: '#ff5722',
    };

    return (
        <Button style={theme} {...props} target={'_blank'}>
            {props.children}
        </Button>
    );
}
