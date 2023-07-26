import {Grid} from "@mui/material";
import {useEffect, useState, lazy} from "react";
const CardItem = lazy(() => import('../components/cards/CardItem.jsx'))
const MainTitle = lazy(() => import('../components/typography/MainTitle.jsx'))

const Home = () => {
    const [data, setData] = useState([]);
    const [titleUrl, setTitleUrl] = useState('');
    const [date] = useState(new Date());

    useEffect(() => {
        const getServerData = async () => {
            const response = await fetch('./api/v1/today');

            if (response.status >= 200 && response.status < 300) {
                const jsonResponse = await response.json();
                setData(jsonResponse.data);
                setTitleUrl(jsonResponse.titleUrl);
            }
        };

        getServerData();
    }, []);

    return (
        <Grid container justifyContent={'center'}>
            <Grid container spacing={5} maxWidth={1280}>
                <Grid item xs={12} alignItems={'center'}>
                    <MainTitle url={titleUrl} />
                </Grid>
                {data.map((item, id) => {
                    return (
                        <CardItem
                            key={id}
                            url={item.url}
                            title={item.title}
                            year={item.year}
                            description={item.description}
                            thumbnail={item.thumbnail} />
                    );
                })}
            </Grid>
        </Grid>
    );
}

export default Home;
