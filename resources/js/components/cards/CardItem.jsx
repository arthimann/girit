import {lazy} from 'react';
import {Grid, Card, CardMedia, CardContent, CardActions} from "@mui/material";
import Typography from '@mui/material/Typography';
const PrimaryButton = lazy(() => import('../buttons/PrimaryButton.jsx'));

const CardItem = (props) => {
    return(
        <Grid item lg={4} md={6} sm={12}>
            <Card className={'card-bg'}>
                <CardMedia
                    className={'item-img'}
                    image={props.thumbnail}
                >
                    <div style={{position: 'relative'}}>
                        <Typography className={'item-title'} variant={'h5'}>{props.title}</Typography>
                        <div className={'primary-bg-color tip'}>{props.year}</div>
                    </div>
                </CardMedia>
                <CardContent style={{height: 100}}>
                    <Typography variant={'body2'}>{props.description}</Typography>
                </CardContent>

                <CardActions style={{textAlign: 'right'}}>
                    <PrimaryButton href={props.url}>READ</PrimaryButton>
                </CardActions>
            </Card>
        </Grid>
    );
}

export default CardItem;
